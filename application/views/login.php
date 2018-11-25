<h3>Welcome to Login</h3>
<form class="m-t" role="form" action="<?php echo base_url();?>login/ajax_login/" id="login" method="post">
    <div class="form-group">
        <?= form_input(['type'  => 'text','name' =>'email','value' => set_value('email', 'eshan@gmail.com'), 'class' =>'form-control', 'placeholder'=>'Email Address','id' => 'email' ]); ?>
        <label class="text-danger email"></label>
    </div>
    <div class="form-group">
        <?= form_input(['type'  => 'password','name' =>'password','value' => set_value('password', '2M@AvDB9y@8&aKQH', false), 'class' =>'form-control', 'placeholder'=>'Password','id' => 'password' ]); ?>

        <label class="text-danger password"></label>
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b" id="submit" onclick="login()">Login</button>
    <div id="messages"></div>
</form>
