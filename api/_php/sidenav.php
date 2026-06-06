<div id="main-sidebar">
    <!-- Mobile User Profile Section (Logged In) -->
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="mobile-user-profile d-md-none">
        <div class="user-profile-header">
            <button class="user-profile-btn" id="userProfileBtn">
                <div class="user-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></span>
                <i class="fas fa-chevron-down user-chevron"></i>
            </button>
        </div>
        <div class="user-profile-menu" id="userProfileMenu">
            <ul class="user-menu-list">
                <li><a href="<?=$websiteUrl?>/profile"><i class="fas fa-user"></i> My Profile</a></li>
                <li><a href="<?=$websiteUrl?>/watchlist"><i class="fas fa-bookmark"></i> Watchlist</a></li>
                <li><a href="<?=$websiteUrl?>/settings"><i class="fas fa-cog"></i> Settings</a></li>
                <li><hr></li>
                <li><a href="<?=$websiteUrl?>/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>
    <?php else: ?>
    <!-- Mobile Login Button (Not Logged In) -->
    <div class="mobile-user-profile d-md-none">
        <button class="btn-login-mobile" id="loginBtnMobile">
            <i class="fas fa-user"></i> Login
        </button>
    </div>
    <?php endif; ?>

    <section class="block_area block_area_sidebar block_area-genres">
        <div class="block_area-header">
            <div class="float-left bah-heading mr-4">
                <h2 class="cat-heading">Genres</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block_area-content">
            <div class="cbox cbox-genres">
                <ul class="ulclear color-list sb-genre-list sb-genre-less">
                <li class="nav-item"> <a class="nav-link" href="../genre/action" title="Action">Action</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/adventure" title="Adventure">Adventure</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/cars" title="Cars">Cars</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/comedy" title="Comedy">Comedy</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/dementia" title="Dementia">Dementia</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/demons" title="Demons">Demons</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/drama" title="Drama">Drama</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/ecchi" title="Ecchi">Ecchi</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/fantasy" title="Fantasy">Fantasy</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/game" title="Game">Game</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/harem" title="Harem">Harem</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/historical" title="Historical">Historical</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/horror" title="Horror">Horror</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/josei" title="Josei">Josei</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/kids" title="Kids">Kids</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/magic" title="Magic">Magic</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/martial+arts" title="Martial Arts">Martial Arts</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/mecha" title="Mecha">Mecha</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/military" title="Military">Military</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/music" title="Music">Music</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/mystery" title="Mystery">Mystery</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/parody" Title="Parody">Parody</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/police" title="Police">Police</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/psychological" title="Psychological">Psychological</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/romance" title="Romance">Romance</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/samurai" title="Samurai">Samurai</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/school" title="School">School</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/sci-fi" title="Sci Fi">Sci Fi</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/seinen" title="Seinen">Seinen</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/shoujo" title="Shoujo">Shoujo</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/shoujo+ai" title="Shoujo Ai">Shoujo Ai</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/shounen" title="Shounen">Shounen</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/shounen+Ai" title="Shounen Ai">Shounen Ai</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/slice+of+life" title="Slice of Life">Slice of Life</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/space" title="Space">Space</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/sports" title="Sports">Sports</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/super+power" title="Super Power">Super Power</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/supernatural" title="Supernatural">Supernatural</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/thriller" title="Thriller">Thriller</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/vampire" title="Vampire">Vampire</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/yaoi" title="Yaoi">Yaoi</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../genre/yuri" title="Yuri">Yuri</a></li>
                </ul>
                <div class="clearfix"></div>
                <button class="btn btn-sm btn-block btn-showmore mt-2"></button>
            </div>
        </div>
    </section>
    <?php include("ads/300x250.html"); ?>
    <section class="block_area block_area_sidebar block_area-realtime">
        <div class="block_area-header">
            <div class="float-left bah-heading mr-2">
                <h2 class="cat-heading">Top Ongoing</h2>
            </div>
            <div class="float-right bah-tab-min">
                <ul class="nav nav-pills nav-fill nav-tabs anw-tabs">
                    <li class="nav-item"><a data-toggle="tab" class="nav-link active">Today</a></li>
                    
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block_area-content">
            <div class="cbox cbox-list cbox-realtime">
                <div class="cbox-content">
                    <div class="tab-content">
                        <div id="today" class="anif-block-ul anif-block-chart tab-pane active">
                            <ul class="ulclear">
                            <?php
							$ch = curl_init();
								  curl_setopt($ch, CURLOPT_URL, "$api/top-airing");
								  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
								  curl_setopt($ch, CURLOPT_HEADER, FALSE);
								  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
								  $resp = curl_exec($ch);
								  $jso = json_decode($resp, true);
                                 
                                  foreach((array) $jso as $key => $trending) { ?>
                                <li class="<?php if($key < 3) echo "item-top"?>">
                                    <div class="film-number"><span><?=$key + 1?></span></div>
                                    <div class="film-poster">
                                        <img data-src="https://ik.imagekit.io/<?=$imgk?>/tr:w-100,f-webp/<?=$trending['animeImg']?>"
                                            class="film-poster-img lazyload tooltipEl" alt="Top trending <?=$trending['animeTitle']?> on Hipanime"
                                            src="https://ik.imagekit.io/<?=$imgk?>/tr:w-100,f-webp/<?=$trending['animeImg']?>" title="<?=$trending['animeTitle']?>">
                                    </div>
                                    <div class="film-detail">
                                        <h3 class="film-name">
                                            <a href="<?=$websiteUrl?>/anime/<?=$trending['animeId']?>" 
                                                title="<?=$trending['animeTitle']?>" data-jname="<?=$trending['animeTitle']?>"><?=$trending['animeTitle']?></a>
                                        </h3>
                                        <div class="fd-infor">
                                            <span class="fdi-item"><?=$trending['latestEp']?></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php } curl_close($ch)?>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile user profile toggle (for logged-in users)
    const userProfileBtn = document.getElementById('userProfileBtn');
    const userProfileMenu = document.getElementById('userProfileMenu');

    if (userProfileBtn && userProfileMenu) {
        userProfileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userProfileMenu.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!userProfileBtn.contains(e.target) && !userProfileMenu.contains(e.target)) {
                userProfileMenu.classList.remove('active');
            }
        });
    }

    // Mobile login button
    const loginBtnMobile = document.getElementById('loginBtnMobile');
    if (loginBtnMobile) {
        loginBtnMobile.addEventListener('click', function() {
            const authModal = document.getElementById('authModal');
            if (authModal) {
                authModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    }
});

// Function called from header.js after successful login
function updateMobileAfterLogin(user) {
    const mobileProfile = document.querySelector('.mobile-user-profile');
    
    if (mobileProfile) {
        mobileProfile.innerHTML = `
            <div class="user-profile-header">
                <button class="user-profile-btn" id="userProfileBtn">
                    <div class="user-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="user-name">${escapeHtml(user.username)}</span>
                    <i class="fas fa-chevron-down user-chevron"></i>
                </button>
            </div>
            <div class="user-profile-menu" id="userProfileMenu">
                <ul class="user-menu-list">
                    <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="/watchlist"><i class="fas fa-bookmark"></i> Watchlist</a></li>
                    <li><a href="/settings"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><hr></li>
                    <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        `;

        // Re-attach event listeners
        const btn = document.getElementById('userProfileBtn');
        const menu = document.getElementById('userProfileMenu');

        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('active');
            });

            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('active');
                }
            });
        }
    }
}

// Helper function
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}
</script>

<style>
.d-md-none {
    display: none;
}

@media (max-width: 768px) {
    .d-md-none {
        display: block !important;
    }

    .mobile-user-profile {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .user-profile-header {
        position: relative;
    }

    .user-profile-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 10px;
        border-radius: 8px;
        transition: background 0.3s ease;
    }

    .user-profile-btn:hover {
        background: #f5f5f5;
    }

    .user-avatar {
        font-size: 32px;
        color: #667eea;
        display: flex;
        align-items: center;
        min-width: 40px;
    }

    .user-name {
        flex: 1;
        font-weight: 600;
        color: #333;
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 14px;
    }

    .user-chevron {
        font-size: 14px;
        color: #999;
        transition: transform 0.3s ease;
    }

    .user-profile-btn.active .user-chevron {
        transform: rotate(180deg);
    }

    .user-profile-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background: #f9f9f9;
    }

    .user-profile-menu.active {
        max-height: 300px;
    }

    .user-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .user-menu-list li {
        margin: 0;
    }

    .user-menu-list a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #333;
        text-decoration: none;
        transition: background 0.2s ease;
        font-size: 14px;
    }

    .user-menu-list a:hover {
        background: #e9ecef;
        color: #667eea;
    }

    .user-menu-list a i {
        width: 18px;
        text-align: center;
    }

    .user-menu-list hr {
        margin: 8px 0;
        border: none;
        border-top: 1px solid #e0e0e0;
    }

    .btn-login-mobile {
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-login-mobile:active {
        transform: scale(0.98);
    }
}
</style>
