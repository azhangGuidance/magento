<?php
$installer = $this;

$cmsPage = Mage::getModel('cms/page')->setStoreId(0)->load('home', 'identifier');
$content = '';
$layout = <<<EOT
<reference name="head">
  <action method="addItem"><type>skin_js</type><name>js/glider.js</name></action>
  <action method="addItem"><type>skin_js</type><name>js/slider.js</name></action>
  <action method="addItem"><type>skin_js</type><name>js/productInfo.js</name></action>
</reference>
<reference name="right">
  <block type="core/template" name="right.callout1" template="callouts/left_col.phtml" before="-">
    <action method="setImgSrc"><src>images/media/callout_side1.jpg</src></action>
    <action method="setImgAlt" translate="alt" module="catalog"><alt>Call Us Toll Free. (555) 555-555</alt></action>
    <action method="setLinkUrl"><url></url></action>
  </block>
  <block type="core/template" name="right.callout2" template="callouts/left_col.phtml" after="right.callout1">
    <action method="setImgSrc"><src>images/media/callout_side2.jpg</src></action>
    <action method="setImgAlt" translate="alt" module="catalog"><alt>Free domestic shippings</alt></action>
    <action method="setLinkUrl"><url></url></action>
  </block>
</reference>
<reference name="content">
  <block type="core/template" name="home.slider" template="page/html/homeslider.phtml"/>
</reference>
<reference name="before_footer">
  <block type="featured/featured" name="home.featured" template="catalog/product/featured.phtml">
    <action method="setProductsCount"><count>5</count></action>
  </block>
</reference>
EOT;

if(!$cmsPage->getId()){
    $cmsPage->setStoreId(0)->setIdentifier('home');
}
$cmsPage->setContent($content)
    ->setStoreId(0)
    ->setRootTemplate('two_columns_right')
    ->setTitle('Home Page')
    ->setLayoutUpdateXml($layout)
    ->save();

$content=<<<EOT
<div class="box informational">
<ul>
  <li><h6>About us</h6>
    <ul>
      <li><a href="{{store direct_url="about"}}">About Us</a></li>
      <li><a href="{{store direct_url="team"}}">Team</a></li>
    </ul>
  </li>
  <li><h6>Customer information</h6>
    <ul>
      <li><a href="{{store direct_url="contacts"}}">Contact Us</a></li>
      <li><a href="{{store direct_url="testimonials"}}">Testimonials</a></li>
    </ul>
  </li>
  <li><h6>Security & privacy</h6>
    <ul>
      <li><a href="{{store direct_url="privacy"}}">Privacy Policy</a></li>
      <li><a href="{{store direct_url="terms"}}">Terms & conditions</a></li>
    </ul>
  </li>
    <li><h6>Career</h6>
    <ul>
      <li><a href="{{store direct_url="opening"}}">Openings</a></li>
      <li><a href="{{store direct_url=""}}">TBD</a></li>
    </ul>
  </li>
</ul>
</div>
EOT;

$staticBlock = array(
    'title' => 'Footer Links',
    'identifier' => 'footer_links',
    'content' => $content,
    'is_active' => 1,
    'stores' => 0
);

$staticBlockModel = Mage::getModel('cms/block')->setStoreId(0)->load('footer_links');

if($id = $staticBlockModel->getBlockId()){
    $staticBlockModel->setData($staticBlock)->setBlockId($id)->save();
}else{
    $staticBlockModel->setData($staticBlock)->save();
}
$installer->endSetup();