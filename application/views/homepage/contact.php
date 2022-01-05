<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?= base_url('assets/img/background.jpg'); ?>);">
    <h2 class="l-text2 t-center">
        <?= $title; ?>
    </h2>
    <p class="m-text13 t-center">
        English Ivy Coffee
    </p>
</section>

<!-- content page -->
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30">
                <div class="p-r-20 p-r-0-lg">
                    <div class="contact-map size21" id="google_map" data-map-x="-7.734746674420123" data-map-y="110.39909645767035" data-pin="<?= base_url('assets/img/icons/icon-maps.png'); ?>" data-scrollwhell="0" data-draggable="1"></div>
                </div>
            </div>

            <div class="col-md-6 p-b-30">
                <form class="leave-comment">
                    <h4 class="m-text25 p-b-36 p-t-15">
                        Send us your message
                    </h4>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name">
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Phone Number">
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address">
                    </div>

                    <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

                    <div class="w-size25">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg15 bo-rad-10 hov7 m-text3 trans-0-4">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>