<?php include('layouts/header.php'); ?>

<!--Contact-->
<div class="container mt-5" style="padding-top: 130px;">
    <div class="row">
    <div class="col-lg-6">
            <div style="width: 100%; max-width: 800px;">
                <iframe class="w-100" height="400"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.080129920298!2d29.17359207574483!3d41.001619319835314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cac7f63b1068af%3A0xd2bca6ca8c60ef84!2zRG_En3XFnyDDnG5pdmVyc2l0ZXNp!5e0!3m2!1str!2str!4v1718645089862!5m2!1str!2str"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="col-lg-6">
            <h2 style="color: coral; text-align: center;">İletişim Formu</h2>
            <form action="server/process_feedback.php" method="POST">
                <div class="form-group mb-3">
                    <label for="name">Adınız:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email Adresiniz:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-4">
                    <label for="feedback">Mesajınız:</label>
                    <textarea class="form-control" id="feedback" name="feedback" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 5px; outline: none; border: none; color: white; background-color: coral; text-decoration: none;">Gönder</button>
            </form>
        </div>
    </div>
</div>

<?php include('layouts/footer.php'); ?>
