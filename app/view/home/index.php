<?php
$HTMLHead = new HTMLHead($data['title']);
$header = new header("home");
?>

<section class="default__section hero_section pt-0">
    <div class="flex__container">

        <div class="cont__left">

            <div class="hero__title mb-2">
                Unlocking the Future of <div class="img__block"><img src="./assets/img/common/astronaut.png" alt=""></div> Education Your All-In-One Student Collaboration Hub
            </div>

            <div class="hero__img m--only">
                <img src="./assets/img/common/astronaut.png" alt="">
            </div>

            <div class="hero__desc mb-1">
                Connecting Students, Enriching Knowledge, and Fostering Collaboration.
                Your Trusted Gateway to Collaborative Learning, Knowledge Sharing, and Peer Engagement in the Digital Age
            </div>

            <div class="hero__btns">
                <a href="./auth?action=register" class="btn btn--primary">Register Now</a>
            </div>

        </div>

        <div class="cont__right m--none">

            <div class="hero__img">
                <img src="./assets/img/common/Untitled design.png" alt="">
            </div>

        </div>

    </div>
    <div class="bg__layer"></div>
</section>

<style>
    /* Hero section */

    section.default__section {
        padding: 3vh 5vw;
    }

    section.section__relative {
        position: relative;
    }

    .hero_section {
        /* min-height: 100vh; */
        width: 100vw;

        padding: 3vh 5vw;

        /* background: url(../img/hero-bg.jpg) no-repeat center center;
    background-size: cover;
     */
    }

    .hero_section .flex__container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .hero_section .cont__left {
        /* background-color: wheat; */
        width: 60%;
    }

    .hero_section .cont__right {
        width: 40%;
        pointer-events: none;
    }

    /* title */
    .hero_section .hero__title {
        font-weight: 700;
        /* was 600 */
        /* font-size: 50px; */

        /* clamp for 50px */
        font-size: clamp(30px, 2.7vw, 48px);
        /* font-size: 2.7vw; */
        /* font-size: 40px; */

        line-height: 168%;

        /* font-weight: 600;
    color: #ffffff;
    text-align: center;
    line-height: 1.5; */
    }

    .default__section .img__block {
        display: inline-block;
        margin: 0 1%;
        width: 12%;
    }

    .hero_section .hero__desc {
        font-weight: 400;
        font-size: 21px;
        line-height: 186%;
        font-size: clamp(15px, 1.1vw, 21px);
    }

    .hero_section .hero__trustpilot {
        display: flex;
        align-items: center;
        text-decoration: inherit;
        color: inherit;
    }

    .hero_section .hero__trustpilot img {
        width: 28px;
        margin: 0 1%;
    }

    .hero_section .hero__btns {
        padding: 1rem 0;
    }

    .hero_section .hero__btns .btn--primary {
        padding: 1rem 2rem;
    }

    .hero_section .bg__layer {
        /* bg image */
        background: url(../img/components/Untitled-min.png) no-repeat center center;
        background-size: cover;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        /* background: var(--primary-color); */

        -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
        mask-image: linear-gradient(to bottom, black 80%, transparent 100%);

        z-index: -1;
    }

    /* tagline */

    .tagline__large {
        width: 50%;
        width: clamp(560px, 50%, 900px);
        margin: 0 auto;

        font-weight: 700;
        /* was 600 */
        font-size: 50px;

        font-size: clamp(35px, 2.7vw, 48px);

        /* line-height: 75px; */
        line-height: 168%;
        text-align: center;
        letter-spacing: -0.500211px;
    }
</style>