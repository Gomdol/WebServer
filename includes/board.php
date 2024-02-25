    <!-- board.php -->

    <section class="board">
        <div id="view_board">
            <div class="table-container">
                <div class="avobe-the-table">

                <form action="main.php?page=board" method="get">
                    <div class="input-group mb-1  flex-grow-0">
                        <select name="type" class="form-select col-1">
                            <option value="all">전체</option>
                            <option value="title">제목</option>
                            <option value="author">작성자</option>
                        </select>

                        <input type="text" name="keyword" class="form-control search-input" placeholder="검색어를 입력하세요.">
                        <button class="btn btn-outline-secondary" id="search-button" type="submit">검색</button>
                    </div>
                </form>


                    <div class="input-group mb-2 justify-content-end flex-grow-1">
                        <!-- a 태그 대신 button 사용 -->
                        <button class="btn btn-outline-secondary" type="button" id="write-button">글쓰기</button>
                    </div>
                </div>
                <script>
                // 검색 관련
                document.getElementById('search-button').addEventListener('click', function(event) {
                event.preventDefault(); // 폼의 기본 제출 동작을 방지

                // 타입과 키워드 입력 값을 가져옴
                let type = document.querySelector('select[name="type"]').value;
                let keyword = document.querySelector('input[name="keyword"]').value;

                // 목표하는 URL 형식에 맞춰 조합
                let targetUrl = `main.php?page=board&type=${encodeURIComponent(type)}&keyword=${encodeURIComponent(keyword)}`;

                // 조합된 URL로 리다이렉트
                window.location.href = targetUrl;
            });


                // 드랍다운 박스 관련
                document.addEventListener('DOMContentLoaded', (event) => {
                document.querySelectorAll('.dropdown-menu a').forEach(item => {
                    item.addEventListener('click', (e) => {
                    let selectedText = e.target.textContent;
                    document.querySelector('#dropdownMenuButton').textContent = selectedText;
                    });
                });
                });

                // 글쓰기 버튼에 클릭 이벤트 리스너 추가
                document.getElementById('write-button').addEventListener('click', function() {
                    // main.php?page=write로 페이지 이동
                    window.location.href = 'main.php?page=write';
                });
                </script>

                <table class="table">
                    <thead>
                        <tr>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once 'db_func.php'; // 데이터베이스 연결 파일

                    // 검색 조건과 키워드 받아오기
                    $search_type = isset($_GET['type']) ? $_GET['type'] : '';
                    $search_keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

                    // 검색 조건에 따른 쿼리 구성
                    $query = "SELECT idx, title, author, creation_date, views FROM board";
                    if (!empty($search_keyword)) {
                        switch ($search_type) {
                            case 'title':
                                $query .= " WHERE title LIKE '%" . mysqli_real_escape_string($db_conn, $search_keyword) . "%'";
                                break;
                            case 'author':
                                $query .= " WHERE author LIKE '%" . mysqli_real_escape_string($db_conn, $search_keyword) . "%'";
                                break;
                            case 'all':
                                // title, author, 그리고 content에서 검색
                                $query .= " WHERE title LIKE '%" . mysqli_real_escape_string($db_conn, $search_keyword) . "%' OR author LIKE '%" . mysqli_real_escape_string($db_conn, $search_keyword) . "%' OR content LIKE '%" . mysqli_real_escape_string($db_conn, $search_keyword) . "%'";
                                break;
                        }
                    }
                    $query .= " ORDER BY idx DESC";

                    $result = mysqli_query($db_conn, $query);

                    // 검색 결과 출력
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><a href='main.php?page=view_post&idx=" . $row["idx"] . "'>" . htmlspecialchars($row["title"]) . "</a></td>";
                            echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['creation_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['views']) . "</td>";
                            echo "</tr>";
                        }                            
                    } else {
                        echo "<tr><td colspan='4'>검색 결과가 없습니다.</td></tr>";
                    }
                    ?>


                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
