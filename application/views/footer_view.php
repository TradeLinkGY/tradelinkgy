<?php
$link_about = '';
$link_tos = '';
$link_privacy = '';
$link_faq = '';
?>
</div>
<div id="footer">
    <p><?=
        anchor($link_about, 'About Us', array('title' => 'Information about TradeLinkGY.com')) . ' | ' .
        anchor($link_tos, 'Terms of Service', array('title' => 'The agreement in writing')) . ' | ' .
        anchor($link_privacy, 'Privacy Policy', array('title' => 'How we use what we collect')) . ' | ' .
        anchor($link_faq, 'FAQ', array('title' => 'Answers to the most commonly asked questions'));
    ?></p>

    <span>Copyright &copy; 2011 TradeLinkGY.com. All Rights Reserved.</span>
</div>
</div>
</body>