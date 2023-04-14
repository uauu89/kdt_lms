<body class="d-flex">
    <header class="d-flex flex-column justify-content-between">
        <div>
            <h1>
                <a href="admin_lecture_list.php" class ="logo" title="관리자 페이지 처음으로">
                    <img src="/kdt_lms/img/logo_white.svg" alt="now"><span class="m_hidden">NOW!</span>
                </a>
            </h1>
            <nav>
                <ul class="d-flex flex-column">
                    <li class="dashboard __cantuse">
                        <a href="#" class="__dis_link" title="대쉬보드">
                            <i class="icon fa-solid fa-table"></i><span class="m_hidden">대쉬보드</span>
                        </a>
                    </li>
                    <li class="lecture">
                        <a href="#" class="__dis_link" title="강의관리">
                            <i class="icon fa-solid fa-chalkboard-user"></i><span class="m_hidden">강의관리</span><i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="admin_lecture_list.php">강의목록</a>
                            </li>
                            <li>
                                <a href="admin_lecture_reg.php">강의등록</a>
                            </li>
                        </ul>
                    </li>

                    <li class="coupon __cantuse">
                        <a href="#" class="__dis_link" title="쿠폰관리">
                            <i class="icon fa-solid fa-ticket-simple"></i><span class="m_hidden">쿠폰관리</span><i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#" class="__dis_link">쿠폰목록</a>
                            </li>
                            <li>
                                <a href="#" class="__dis_link">쿠폰관리</a>
                            </li>
                        </ul>
                    </li>
                    <li class="board __cantuse">
                        <a href="#" class="__dis_link" title="게시판">
                            <i class="icon fa-solid fa-note-sticky"></i><span class="m_hidden">게시판</span><i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#" class="__dis_link">공지사항</a>
                            </li>
                            <li>
                                <a href="#" class="__dis_link">자유게시판</a>
                            </li>
                        </ul>
                    </li>
                    <li class="member __cantuse">
                        <a href="#" class="__dis_link" title="회원관리">
                            <i class="icon fa-solid fa-address-card"></i><span class="m_hidden">회원관리</span>
                        </a>
                    </li>
                    <li class="setting __cantuse">
                        <a href="#" class="__dis_link" title="설정">
                            <i class="icon fa-solid fa-gear"></i><span class="m_hidden">설정</span>
                        </a>
                    </li>
                </ul>
                <button type="button"><i class="fa-solid fa-angle-left"></i></button>
            </nav>
        </div>
        <div class="profile">
            <section class="d-flex align-items-center gap-3">
                <h2 class="__hidden">admin profile</h2>
                <div class="pimg">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="pinfo m_hidden">
                    <p class="pname"><?php echo $_SESSION['SSNAME']; ?></p>
                    <p class="ppos"><?php echo $_SESSION['SSPOS']; ?></p>
                </div>
            </section>
            <a href="admin_logout.php" class="logout" title="로그아웃">
                <span class="m_hidden">Logout</span><i class="icon fa-solid fa-right-from-bracket"></i>
            </a>

        </div>
    </header>