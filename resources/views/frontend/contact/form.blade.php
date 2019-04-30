<div class="tx-powermail">
<form action="{{url('contact')}}" method="POST" name="create-contacts">
    @csrf
    <?php
    $type = 'enquiry';
    if (Request::is('service/contact')) {
        $type = 'contact';
    } elseif (Request::is('service/after-sales-support')) {
        $type = 'after-sales-support';
    }
    ?>
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="item" value="<?= (isset($_GET['component']) ? intval($_GET['component']) : '') ; ?>">
    <h3>Contact</h3>
    <div style="padding-top:20px; color:green">
        @include('common.sessionMessage')
    </div>
    <fieldset class="powermail_fieldset">
        <legend class="powermail_legend">Contact Information</legend>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                First Name:<span class="mandatory">*</span>
            </label>
            <input class="powermail_field powermail_input" required="required" type="text" name="firstname">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Last Name:<span class="mandatory">*</span>
            </label>
            <input class="powermail_field powermail_input" required="required" type="text" name="lastname">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Company:
            </label>
            <input class="powermail_field powermail_input" type="text" name="company">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Position:
            </label>
            <input class="powermail_field powermail_input" type="text" name="position" >
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                E-Mail:<span class="mandatory">*</span>
            </label>
            <input class="powermail_field powermail_input" required="required" type="email" name="email">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Phone:
            </label>
            <input class="powermail_field powermail_input" type="tel" name="phone">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Fax:
            </label>
            <input class="powermail_field powermail_input" type="tel" name="fax">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Street:
            </label>
            <input class="powermail_field powermail_input" type="text" name="street">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                ZIP Code:
            </label>
            <input class="powermail_field powermail_input" type="text" name="zipcode">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                City：
            </label>
            <input class="powermail_field powermail_input" type="text" name="city">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Country:
            </label>
            <input class="powermail_field powermail_input" type="text" name="country">
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_input">
            <label class="powermail_label">
                Comment:
            </label>
            <textarea class="powermail_field powermail_textarea" rows="5" cols="20" name="comment"></textarea>
        </div>
        <div class="powermail_fieldwrap powermail_fieldwrap_submit">
            <input class="powermail_field powermail_submit" type="submit" value="Submit">
        </div>
    </fieldset>
    </div>
</form>
</div>