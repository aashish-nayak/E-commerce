<div class="contact-form-content mt-50 p-4 bg-white">
    <h4 class="contact-page-title">Drop your Message</h4>
    <div class="contact-form">
        <form onsubmit="return validateForm(this);" name="myform" method="POST" action="thank-you.php" role="form">
            <div class="form-group mb-15">
                <input style="height: 40px;padding-left:10px;font-size:15px;" type="text" name="name" placeholder="Name" required=""> <span class="required"></span>
            </div>
            <div class="form-group mb-15">
                <input style="height: 40px;padding-left:10px;font-size:15px;" type="email" name="email" placeholder="Email" required=""> <span class="required"></span>
            </div>
            <div class="form-group mb-15">
                <input style="height: 40px;padding-left:10px;font-size:15px;" type="text" name="phone" placeholder="Phone Number"> <span class="required"></span>
            </div>
            <div class="form-group mb-15">
                <input style="height: 40px;padding-left:10px;font-size:15px;" type="text" name="city" placeholder="City" required> <span class="required"></span>
            </div>
            <div class="form-group mb-20">
                <textarea name="message" style="padding-left: 10px;font-size:15px;" placeholder="Type Your Message..."></textarea> <span class="required"></span>
            </div>
            <div class="form-group">
                <button type="submit" value="submit" class="li-btn-3" name="submit">Enquiry Now</button>
            </div>
        </form>
    </div>
</div>