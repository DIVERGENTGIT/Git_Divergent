<h2> Forgot Password? </h2>
<?php if(isset($issued)): ?>
    <div class="valid_box">
        <?php echo $issued; ?>
    </div>
<?php else: ?>
    <?php if(isset($not_exist)): ?>
        <div class="error_box">
            <?php echo $not_exist; ?>
        </div>
    <?php else: ?>
        <div class="warning_box">
            Get New Password for the User Name
        </div>
    <?php endif; ?>
<?php endif; ?>
<div class="form">
    <?php echo form_open('index/forgot',
                    array('id' => 'forgot_form', 'name' => 'forgot_form', 'class' => 'niceform', 'method' => 'post')
    ); ?>
    <fieldset>
        <dl>
            <dt><label for="username">Username:</label></dt>
            <dd>
                <?php echo form_input(array('name' => 'username', 'id' => 'username', 'value' => set_value('username'), 'class' => 'inputText')); ?>
                <div class="form_error"><?php echo form_error('username'); ?></div>
            </dd>
        </dl>
        <dl class="submit">
            <?php echo form_submit(array('name' => 'forgot_password','value' => 'Submit','class' => 'button'));?>
        </dl>
    </fieldset>

    <?php echo form_close(); ?>
</div>
