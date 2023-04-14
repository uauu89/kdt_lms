<aside class="">
    <button class="btn_mAside"></button>
    <div class="myInfo">
        <p>안녕하세요,</p>
        <p><?php echo $_SESSION['SSNAME']; ?> 님!</p>
    </div>
    <nav>
        <ul class="d-flex flex-column">
            <li><a href="user_my_class.php">내 강의실</a></li>
            <li><a href="user_my_payment_history.php">구매내역</a></li>
            <li><a href="user_my_cart.php">장바구니</a></li>
            <li><a href="user_my_modify_conn.php">회원정보 수정</a></li>
            <li><a href="/kdt_lms/inc/user_logout.php" title="로그아웃">로그아웃</a></li>
        </ul>
    </nav>
</aside>
