'use strict';

(function ($) {
  $.fn.unveil = function (threshold, callback) {
    var $w = jQuery(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina ? "data-src-retina" : "data-src",
        images = this,
        loaded;
    this.one("unveil", function () {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");

      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function () {
        var $e = jQuery(this),
            wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();
        return eb >= wt - th && et <= wb + th;
      });
      loaded = inview.trigger("unveil");
      images = images.not(loaded);
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);
    unveil();
    return this;
  };
})(window.jQuery || window.Zepto);

let intImageLoad = (childClass, parentClass) => {
  var $images = jQuery(childClass);

  if ($images.length) {
    $images.unveil(1, function () {
      jQuery(this).on('load', function () {
        jQuery(this).parents(parentClass).first().addClass('image-loaded');
        jQuery(this).removeAttr('data-src');
        jQuery(this).removeAttr('data-srcset');
        jQuery(this).removeAttr('data-sizes');
      });
    });
  }
};

let initImageProduct = () => {
  var $images = jQuery('.product-image:not(.image-loaded) .unveil-image, .tbay-gallery-varible:not(.image-loaded) .unveil-image');

  if ($images.length) {
    $images.unveil(1, function () {
      jQuery(this).on('load', function () {
        jQuery(this).parents('.product-image, .tbay-gallery-varible').first().addClass('image-loaded');
        jQuery(this).removeAttr('data-src');
      });
    });
  }
};

let layzyLoadImage = () => {
  jQuery(window).off('scroll.unveil resize.unveil lookup.unveil');
  intImageLoad('.tbay-image-loaded:not(.image-loaded) .unveil-image', '.tbay-image-loaded');
  initImageProduct();
};

jQuery(document).ready(function ($) {
  setTimeout(function () {
    layzyLoadImage();
  }, 200);
  jQuery(document.body).on('greenmart_load_more', () => {
    layzyLoadImage();
  });
  jQuery(document.body).on('greenmart_tabs_carousel', () => {
    layzyLoadImage();
  });
  jQuery(document.body).on('reset_image', () => {
    layzyLoadImage();
  });
  jQuery(document.body).on('reset_data', () => {
    layzyLoadImage();
  });
});

var CustomlayzyLoadImage = function ($scope, $) {
  setTimeout(function () {
    layzyLoadImage();
  }, 200);
};

jQuery(window).on('elementor/frontend/init', function () {
  if (typeof greenmart_settings !== "undefined" && greenmart_settings.skin_elementor && jQuery.isArray(greenmart_settings.elements_ready.layzyloadimage)) {
    $.each(greenmart_settings.elements_ready.layzyloadimage, function (index, value) {
      elementorFrontend.hooks.addAction('frontend/element_ready/tbay-' + value + '.default', CustomlayzyLoadImage);
    });
  }
});
