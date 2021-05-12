<?php
define('SITE', 1);
define('SITE_ROOT', './');
require SITE_ROOT . 'includes/header.php';
?>
  <div id="slider-slides-content" style="display:none">
    <span data-image="/img/photo-mp.jpg"></span>
    <span data-image="/img/photo-mp-3.jpg"></span>
    <span data-image="/img/photo-mp-4.jpg"></span>
    <span data-image="/img/photo-mp-5.jpg"></span>
    <span data-image="/img/photo-mp-6.jpg"></span>
  </div>
  <div id="main-slider">
    <div id="slider-buttons"></div>
    <div id="slider-content"></div>
  </div>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var slides = $('#slider-slides-content').clone();
      $('#slider-slides-content').remove();
      slides.children('span').each(function(i) {
        $('#slider-content').append('<a target="_blank" href="' + ($(this).attr('data-url') || 'javascript://') + '"><div class="slider-page" style="display:none;background-image:url(' + $(this).attr('data-image') + ')">' + ($.trim($(this).html()).length ? '<span class="slider-page-description"><span class="slider-page-description-inner">' + $(this).html() + '</span></span>' : '') + '</div></a>');
      });
      $('.slider-page:first').show();
      var sliderPageCount = $('.slider-page').length;
      for (var i = 0; i < sliderPageCount; ++i) {
        $('#slider-buttons').append('<span id="slider-button-'+i+'" class="slider-button"></span>');
      }
      $('.slider-button:first').addClass('active');
      $('.slider-page').each(function(i) {
        $(this).attr('id', 'slider-page-'+i);
      });
      var interval = 5*1000;
      var timer;
      var currentPageId = 0;
      function sliderAction() {
        currentPageId++;
        if (currentPageId >= sliderPageCount){
          currentPageId = 0;
        }
        toggleSlider(currentPageId);
        timer = setTimeout(sliderAction, interval);
      }
      function toggleSlider(pageId){
        if ($('#slider-page-'+pageId).is(':visible')){
          return;
        }
        $('.slider-button').removeClass('active');
        $('#slider-button-'+pageId).addClass('active');
        $('.slider-page').fadeOut();
        $('#slider-page-'+pageId).fadeIn();
      }
      timer = setTimeout(sliderAction, interval);
      $('.slider-button').click(function(){
        var id = +$(this).attr('id').split('-')[2];
        toggleSlider(id);
        currentPageId = id;
        clearTimeout(timer);
        timer = setTimeout(sliderAction, interval);
      });
      $('#slider-content').hover(function(){
        clearTimeout(timer);
        timer = setTimeout(sliderAction, interval);
      }, function(){
        clearTimeout(timer);
        timer = setTimeout(sliderAction, interval);
      });
    });
  </script>
  <section>
    <p>Добро пожаловать в мир чудес и невесомости!</p>
    <p>Воздушная гимнастика, растяжка и акробатика для всех желающих!</p>
  </section>
  <section>
    <div id="vk-wall">
      <!-- много div-ов -->  
      <div class="vk-post" id="vk-post-{post-id}">
        <a href="{vk-link-to-post}">
          <div class="vk-post-title">
            <div class="vk-post-author">{vk-post-name}</div>
            <div class="vk-post-date">{vk-post-date}</div>
            <div class="vk-post-avatar"><img src="{vk-link-to-avatar}"/></div>
          </div>  
          <div class="vk-post-content">
            {vk-post-text}
          </div>
          <div class="vk-post-attachments">
            <!-- вложение - фото -->
            <span class="vk-post-attachment">
              <a href="{link-to-photo}">
                <img src="{link-to-photo-preview}">
              </a>
            </span>
            <!-- вложение - документ -->
            <span class="vk-post-attachment-description">
              <a href="{link-to-document}">
                {name-of-document}
              </a>
            </span>
          </div>
        </a>
      </div>
      <!-- много div-ов -->
    </div>
  </section>
<?php
require SITE_ROOT . 'includes/footer.php';
?>