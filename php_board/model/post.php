<?php
    include_once '../db.php';

    function getPost($category, $search) {
        if(isset($category) && isset($search)) {
            if($category == "bm_name") {
                $queryResult = DBQuery("select * from board_member where bm_name like '%$search%'");
                return $queryResult;
            } else {
                $queryResult = DBQuery("select * from board_post where $category like '%$search%'");
                return $queryResult;
            }
        } else {
            $queryResult = DBQuery("select * from board_post");
            return $queryResult;
        }
    }
    
    function isPostIdxValid($idx) {
        $postQuery = searchPostByIDX($idx);
        $postQuery = $postQuery->fetch();

        if($postQuery >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function readPostList($startLimit,$limit,$category,$search,$order) {
        if(isset($order) && $order == "hit") {
            $queryResult = DBQuery("select * from board_post order by bp_hit desc, idx desc limit $startLimit,$limit");
        } else {
            $queryResult = DBQuery("select * from board_post order by idx desc limit $startLimit,$limit");
        }

        if(isset($category) && isset($search)) {
            if($category == "bm_name") {
                if(isset($order) && $order == "hit") {
                    $queryResult = DBQuery("SELECT * FROM board_post WHERE mem_idx IN (SELECT idx FROM board_member WHERE bm_name LIKE '%$search%') ORDER BY bp_hit DESC, idx DESC LIMIT $startLimit,$limit");
                } else {
                    $queryResult = DBQuery("SELECT * FROM board_post WHERE mem_idx IN (SELECT idx FROM board_member WHERE bm_name LIKE '%$search%') ORDER BY idx DESC LIMIT $startLimit,$limit");
                }
            } else {
                if(isset($order) && $order == "hit") {
                    $queryResult = DBQuery("select * from board_post where $category like '%$search%' order by bp_hit desc, idx desc limit $startLimit,$limit");
                } else {
                    $queryResult = DBQuery("select * from board_post where $category like '%$search%' order by idx desc limit $startLimit,$limit");
                }
            }
        }
        $rowCount = $queryResult->rowCount();
        if($rowCount < 1) {
            ?>
            <h1 style="margin-top: 100px; text-align: center;">Theres No Result</h1>
            <?php
            return;
        }
        while($postList = $queryResult->fetch()) {
            $searchNameQuery = DBQuery("select * from board_member where idx = '{$postList['mem_idx']}'");
            $findName = $searchNameQuery->fetch();
            $title = $postList["bp_title"];
            $writetime = dateConversion($postList['bp_create_time']);
            if(strlen($title) > 30) {
                $title = str_replace($postList["bp_title"], mb_substr($postList["bp_title"], 0, 30, "utf-8")."...", $postList["bp_title"]);
            }
        ?>
        <tbody>
            <tr>
                <td width="70"><?php echo $postList['idx'] ?></td>
                <td width="500"><a href="/view/readpage.php?idx=<?php echo $postList['idx']; ?>"><?php echo $title; if($postList['bp_comment_count'] >= 1) echo " [".$postList['bp_comment_count']."]" ?></a></td>
                <td width="120"><a href=""><?php echo $findName['bm_name'] ?></a></td>
                <td width="150"><?php echo $writetime ?></td>
                <td width="100"><?php echo $postList['bp_hit'] ?></td>
            </tr>
        </tbody>
    <?php
        }
    }

    function searchPostByIDX($idx) {
        $queryResult = DBQuery("select * from board_post where idx='{$idx}'");
        return $queryResult;
    }

    function somebodyHitPost($idx) {
        $searchHitQuery = searchPostByIDX($idx);
        $findHit = $searchHitQuery->fetch();
        $findHit = $findHit['bp_hit'] + 1;
        $queryResult = DBQuery("update board_post set bp_hit = '{$findHit}' where idx = '{$idx}'");
        return $queryResult;
    }

    function dateConversion($time) {
        $writetime = date("Y-m-d | h:i:s", $time);
        return $writetime;
    }

    function confirmPostWasMine($memberId, $postIdx) {
        $memberQuery = DBQuery("select * from board_member where bm_id = '{$memberId}'");
        $findMember = $memberQuery->fetch();
        $memberIDX = $findMember['idx'];

        $postQuery = searchPostByIDX($postIdx);
        $findPost = $postQuery->fetch();
        $postMemIdx = $findPost['mem_idx'];

        return $memberIDX == $postMemIdx;
    }

    function showModifyAndDelete($memberId, $postIdx) {
        if(confirmPostWasMine($memberId, $postIdx)) {
            ?>
                <li><a href="../view/modifypage.php?idx=<?php echo $postIdx; ?>">[Modify]</a></li>
                <li><a href="../controller/delete.php?idx=<?php echo $postIdx; ?>">[Delete]</a></li>
            <?php
        }
    }

    function getPageNum($page) {
        if(isset($page)) {
            return $page;
        } else {
            return 1;
        }
    }

    function getListNum($list) {
        if(isset($list)) {
            return $list;
        } else {
            return 30;
        }
    }

    function calcBlockData($page, $block_ct) {
        $block['num'] = ceil($page/$block_ct);
        $block['start'] = (($block['num'] - 1) * $block_ct) + 1;
        $block['end'] = $block['start'] + $block_ct - 1;
        return $block;
    }

    function calcPageData($row_num, $list, $block_ct) {
        $total['page'] = ceil($row_num/$list);
        $total['block'] = ceil($total['page']/$block_ct);
        return $total;
    }

    function pagingButton($category, $search, $order, $page, $list, $message) {
        if(isset($category) && isset($search)) {
            if(isset($order)) echo "<li><a href='?page=$page&list=$list&order=$order&category=$category&search=$search'>$message</a></li>";
            else echo "<li><a href='?page=$page&list=$list&category=$category&search=$search'>$message</a></li>";
        } else {
            if(isset($order)) echo "<li><a href='?page=1&list=$list&order=$order'>$message</a></li>";
            else echo "<li><a href='?page=$page&list=$list'>$message</a></li>";
        }
    }

    function showPagingView($page, $block, $total, $list, $category, $search, $order) {
        if($page <= 1) {
            echo "<li class='fo_re'>First</li>";
        } else {
            pagingButton($category, $search, $order, 1, $list, "First");
            // if(isset($category) && isset($search)) {
            //     if(isset($order)) echo "<li><a href='?page=1&list=$list&order=$order&category=$category&search=$search'>First</a></li>";
            //     else echo "<li><a href='?page=1&list=$list&category=$category&search=$search'>First</a></li>";
            // } else {
            //     if(isset($order)) echo "<li><a href='?page=1&list=$list&order=$order'>First</a></li>";
            //     else echo "<li><a href='?page=1&list=$list'>First</a></li>";
            // }
        }
        
        if($page <= 1) {

        } else {
            $pre = $page - 1;
            // pagingButton($category, $search, $order, $pre, $list, "Prev");
            if(isset($category) && isset($search)) {
                if(isset($order)) echo "<li><a href='?page=$pre&list=$list&order=$order&category=$category&search=$search'>Prev</a></li>";
                else echo "<li><a href='?page=$pre&list=$list&category=$category&search=$search'>Prev</a></li>";
            } else {
                if(isset($order)) echo "<li><a href='?page=$pre&list=$list&order=$order'>Prev</a></li>";
                else echo "<li><a href='?page=$pre&list=$list'>Prev</a></li>";
            }
            
        }

        for($i = $block['start']; $i <= $block['end']; $i++) {
            if($page == $i) {
                echo "<li class='fo_re'>[$i]</li>";
            } else {
                if(isset($category) && isset($search)) {
                    if(isset($order)) echo "<li><a href='?page=$i&list=$list&order=$order&category=$category&search=$search'>[$i]</a></li>";
                    else echo "<li><a href='?page=$i&list=$list&category=$category&search=$search'>[$i]</a></li>";
                } else {
                    if(isset($order)) echo "<li><a href='?page=$i&list=$list&order=$order'>[$i]</a></li>";
                    else echo "<li><a href='?page=$i&list=$list'>[$i]</a></li>";
                }
                
            }
        }

        if($page >= $total['page']) {

        } else {
            $next = $page + 1;
            if(isset($category) && isset($search)) {
                if(isset($order)) echo "<li><a href='?page=$next&list=$list&order=$order&category=$category&search=$search'>Next</a></li>";
                else echo "<li><a href='?page=$next&list=$list&category=$category&search=$search'>Next</a></li>";
            } else {
                if(isset($order)) echo "<li><a href='?page=$next&list=$list&order=$order'>Next</a></li>";
                else echo "<li><a href='?page=$next&list=$list'>Next</a></li>";
            }
            
        }

        if($page >= $total['page']) {
            echo "<li class='fo_re'>Last</li>";
        } else {
            if(isset($category) && isset($search)) {
                if(isset($order)) echo "<li><a href='?page=$total[page]&list=$list&order=$order&category=$category&search=$search'>Last</a></li>";
                else echo "<li><a href='?page=$total[page]&list=$list&category=$category&search=$search'>Last</a></li>";
            } else {
                if(isset($order)) echo "<li><a href='?page=$total[page]&list=$list&order=$order'>Last</a></li>";
                else echo "<li><a href='?page=$total[page]&list=$list'>Last</a></li>";
            }
            
        }
    }

    function showSearchBox($list, $order) {
        ?>
        <span id="search_box">
            <form action="/view/mainpage.php" method="get">
                <input type="hidden" name="list" value="<?php if(isset($list)) echo $list; else echo 30; ?>">
                <input type="hidden" name="order" value="<?php if(isset($order)) echo $order; else echo 'default'; ?>">
                <select name="category" style="font-weight: bold; border-style: none; border-radius: 10px; background-color: rgba(0, 0, 0, 0); color: #fc9f00;">
                    <option value="bp_title" <?php echo isSelected($_GET['category'],"bp_title"); ?>>title</option>
                    <option value="bm_name" <?php echo isSelected($_GET['category'],"bm_name"); ?>>name</option>
                    <option value="bp_contents" <?php echo isSelected($_GET['category'],"bp_contents"); ?>>content</option>
                </select>
                <input type="text" name="search" style="border-style: none; border-radius: 10px; margin-left: 10px; margin-right: 10px;" size="40" required="required" value="<?php echo $_GET['search']; ?>" />
                <button style="background-color: rgba(0, 0, 0, 0); border-style: none; border-radius: 10px; font-weight: bold; color: #fc9f00;">Search</button>
            </form>
        </span>
        <?php
    }

    function isSelected($category,$categoryName) {
        if(isset($category) && $category == $categoryName)
            return "selected";
        elseif(!isset($category) && $categoryName == 30)
            return "selected";
    }

    function showAppBar() {
        ?>
        <header class="mdc-top-app-bar" style="left: 0; background: rgb(162,0,255); background: linear-gradient(90deg, rgba(162,0,255,1) 0%, rgba(91,3,250,1) 56%, rgba(55,4,255,1) 100%);">
            <div class="mdc-top-app-bar__row">
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                    <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Open navigation menu"><a href="/view/profilepage.php" style="color: white;">account_circle</a></button>
                    <span class="mdc-top-app-bar__title">
                        <a href="/" style="text-decoration: none;">
                            <h1 style="font-weight: bold; color: white; margin-bottom: 30px;">Free Board</h1>
                        </a>
                    </span>
                    <span class="mdc-top-app-bar__title">
                        <h4>You can write freely!</h4>
                    </span>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-middle" style="color: black;">
                <?php
                echo showSearchBox($_GET['list'], $_GET['order']);
                ?>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                    <div class="btn-group" style="margin-right: 10px;">
                        <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-label="Options">more_vert
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/controller/logout.php">Logout</a></li>
                            <li><a href="/view/signpage.php">Sign</a></li>
                            <li><a href="/view/writepage.php">Write</a></li>
                        </ul>
                    </div>
                <?php echo showMember(); ?>
                </section>
            </div>
        </header>
        <?php
    }
?>