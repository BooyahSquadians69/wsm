<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@600&display=swap" rel="stylesheet">

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSM • REFER</title>
</head>

<body>
    <?php
    require('./components/header.php');
    require('./components/_dbconnect.php');

    if (!isset($_SESSION)) {
        session_start();
    }


    ?>
    <style>
        .heading{
            color: rgb(11, 8, 58);
        }
        .main{
            color: rgb(229, 57, 53);
        }
        .thing{
            color: rgb(76, 175, 80);
        }
        .stuff{
            color: rgb(3, 169, 244);            
        }
    </style>
    <div class="grid place-items-center">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto flex flex-wrap">
                <div class="flex relative pt-10 pb-20 sm:items-center md:w-2/3 mx-auto">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">1</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <img src="../src/img/icons/refer.png" alt="">
                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Reffer</h2>
                            <p class="leading-relaxed">Reffer this website to your friend or classmates</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">2</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <img src="../src/img/icons/register.png" style="max-width:75%" alt="">
                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Register</h2>
                            <p class="leading-relaxed">Tell him to register with your referral code.</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">3</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <img src="../src/img/icons/point.png" style="max-width:100%" alt="">
                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Get Points</h2>
                            <p class="leading-relaxed">For each register you will get 100 magazine points.</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-10 sm:items-center md:w-2/3 mx-auto">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">4</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <img src="../src/img/icons/reward.png" style="max-width:75%" alt="">
                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Earn Rewards</h2>
                            <p class="leading-relaxed">Redeem your points as rewards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="main body-font">
            <div class="flex-grow sm:pl-6 mt-6 sm:mt-0 grid p-4 place-items-center">
                <h1 style="font-family: 'Teko', sans-serif" class="heading text-6xl">Your Referral Code</h1>
                <?php
                if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
                    echo '<div class="alert alert-danger m-4" role="alert">
                    You need to login first to generate your referral code and referral link.
                    </div>';
                } else if (isset($_SESSION['logged_in']) && !isset($_SESSION['ref_code'])) {
                    echo '<div class="alert alert-danger m-4" role="alert">
                    Sorry! An error occured please try re-login.
                    </div>';
                } else {
                ?>
                    <p class="text-2xl font-semibold pt-4 main text-center">Here is your referral code/link which you can send to your friend to register with</p>
                    <p class="text-2xl font-semibold pt-4 thing text-center">Referral Points
                        <p class="text-2xl stuff font-semibold text-center">
                            <?php
                            $username = $_SESSION['username'];
                            $sql = "SELECT `referral_points` FROM `website_users` WHERE `username` = '$username'";
                            $result = mysqli_query($conn, $sql);
                            $result_fetch = mysqli_fetch_assoc($result);
                            echo $result_fetch['referral_points'];
                            ?>
                        </p>
                    </p>
                    <p class="text-2xl main font-semibold pt-4 thing text-center">Referral Code
                        <p class="text-2xl stuff font-semibold text-center">
                            <?php echo $_SESSION['ref_code']; ?>
                        </p>
                    </p>
                    <p class="text-2xl main font-semibold pt-4 thing text-center">Referral Link
                        <a href="<?php echo 'http://weekly-student-magazine.epizy.com/register.php?ref_code=' . $_SESSION['ref_code']; ?>">
                            <p class="text-2xl stuff font-semibold text-center">
                                <?php echo 'http://weekly-student-magazine.epizy.com/register.php?ref_code=' . $_SESSION['ref_code']; ?>
                            </p>
                    </p></a>
                    <p class="text-2xl main font-semibold pt-8 text-center">You can share this link with your friend and it will automatically set your referral code in the form
                        Or you can share the referral code and say your friend to fill the form with this referral code
                        Its better if you share the link.</p>
                <?php }
                ?>
            </div>
        </section>
        <section class="text-gray-600 body-font">
            <div class="flex-grow sm:pl-6 mt-6 sm:mt-0 grid p-4 place-items-center">
                <h1 style="font-family: 'Teko', sans-serif" class="text-6xl heading">Referral Rewards</h1><br>
                <p class="text-2xl main font-semibold text-center">
                    Referral rewards is a system by which you can refer this website to your friend or classmates and tell them to register with your referral code and in return you will get some points which you can use to amazing redeem rewards.</p>
            </div>
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                        <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 562 562" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path style="fill:#1F63AD;" d="M269.446,446.076L169.272,416.01c-21.358-6.391-35.706-25.663-35.706-47.934v-41.967
	                                c0-11.479,11.216-19.201,21.49-15.978l166.957,50.087c7.076,2.119,11.902,8.608,11.902,15.978v21.914
	                                c0,15.978-7.369,30.652-20.185,40.174C300.611,448.048,284.247,450.607,269.446,446.076z M166.957,348.544v19.533
	                                c0,7.402,4.794,13.826,11.902,15.978l100.174,30.066c11.188,3.228,21.49-5.178,21.49-16.011v-9.489L166.957,348.544z" />
                                <path style="fill:#004999;" d="M322.011,360.218l-88.272-26.483v34.846l66.783,20.038v9.489c0,10.832-10.3,19.237-21.49,16.011
	                                l-45.293-13.594v34.834l35.706,10.716c14.8,4.53,31.164,1.971,44.282-7.794c12.816-9.521,20.                               185-24.195,20.185-40.173v-21.914
	                                C333.913,368.826,329.087,362.337,322.011,360.218z" />
                                <polygon style="fill:#FFAA00;" points="467.478,73.282 66.783,193.489 66.783,318.506 467.478,438.717 " />
                                <polygon style="fill:#F28D00;" points="467.478,256 66.783,256 66.783,318.506 467.478,438.717 " />
                                <path style="fill:#E6F3FF;" d="M478.609,456.348c-18.424,0-33.391-14.967-33.391-33.391V89.043
	                                c0-18.424,14.967-33.391,33.391-33.391S512,70.619,512,89.043v333.913C512,441.381,497.033,456.348,478.609,456.348z" />
                                <path style="fill:#B8D0E6;" d="M445.217,256v166.957c0,18.424,14.967,33.391,33.391,33.391S512,441.381,512,422.957V256H445.217z" />
                                <path style="fill:#E6F3FF;" d="M33.391,356.174C14.984,356.174,0,341.207,0,322.783V189.217c0-18.424,14.984-33.391,33.391-33.391
	                                s33.391,14.967,33.391,33.391v133.565C66.783,341.207,51.799,356.174,33.391,356.174z" />
                                <path style="fill:#B8D0E6;" d="M0,256v66.783c0,18.424,14.984,33.391,33.391,33.391s33.391-14.967,33.391-33.391V256H0z" />
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                        </div>
                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-2">Promotion in WSM Instagram and Discord</h2>
                            <p class="leading-relaxed text-base">We can promote you in the WSM instagram page and discord server</p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center" href="../buy/promo.php">Buy
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="container grid place-items-center p-4">
                        <p class="ml-3 text-4xl" style="font-family: 'Teko', sans-serif;">More rewards comming soon....Suggest us some reward ideas in <a href="./contact.php"> contact us</a> page.</p>
                    </div>
                    <!-- <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-2">The Catalyzer</h2>
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center">Learn More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="sm:w-32 sm:order-none order-first sm:h-32 h-20 w-20 sm:ml-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="sm:w-16 sm:h-16 w-10 h-10" viewBox="0 0 24 24">
                                <circle cx="6" cy="6" r="3"></circle>
                                <circle cx="6" cy="18" r="3"></circle>
                                <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center lg:w-3/5 mx-auto sm:flex-row flex-col">
                        <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="sm:w-16 sm:h-16 w-10 h-10" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-2">The 400 Blows</h2>
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center">Learn More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div> -->
                    <!-- <button class="flex mx-auto mt-20 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button> -->
                </div>
            </section>
        </section>
    </div>
    <?php
    require('./components/footer.php')
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>