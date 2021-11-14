/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/_application-locations.js":
/*!************************************************!*\
  !*** ./resources/js/_application-locations.js ***!
  \************************************************/
/***/ (() => {

/**
 * Partial: Location Utilities
 *
 * Responsible for all the tweaks related to load
 * location data conditionally.
 */
// ------------------------------------------
// Get the application data in JavaScript.
// Coming from admin.blade.php
// ------------------------------------------
var app = jQuery.parseJSON(app_data);
jQuery(document).ready(function ($) {
  var app_locale = app.app_locale;
  /**
   * Load District
   * Load the corresponding District based on the Division choice.
   * @return {mixed} Select field.
   * ---------------------------------------------------------------------
   */

  $('body').on('change', '#division', function () {
    var division_id = $(this).val();
    $.get(app.app_url + 'getDistrict/' + division_id, function (data) {
      var district_id = $('#district');

      if (district_id.length > 0) {
        //success data
        district_id.empty();
        district_id.append('<option value="">' + app.label_select + '</option>');
        $.each(data, function (index, subcatObj) {
          district_id.append('<option value="' + subcatObj.id + '">' + (subcatObj["name_".concat(app_locale)] ? subcatObj["name_".concat(app_locale)] : subcatObj.name_en) + '</option>');
        });
        /**
         * Trigger only for select2
         */

        district_id.val('').trigger('change');
      }
    });
  });
  /**
   * Load Thana Upazila
   * Load the corresponding Thana Upazila based on the District choice.
   * @return {mixed} Select field.
   * ---------------------------------------------------------------------
   */

  $('body').on('change', '#district', function () {
    var district_id = $(this).val();
    $.get(app.app_url + 'getThanaUpazila/' + district_id, function (data) {
      var thana_upazila_id = $('#thana-upazila');

      if (thana_upazila_id.length > 0) {
        //success data
        thana_upazila_id.empty();
        thana_upazila_id.append('<option value="">' + app.label_select + '</option>');
        $.each(data, function (index, subcatObj) {
          thana_upazila_id.append('<option value="' + subcatObj.id + '">' + (subcatObj["name_".concat(app_locale)] ? subcatObj["name_".concat(app_locale)] : subcatObj.name_en) + '</option>');
        });
        /**
         * Trigger only for select2
         */

        thana_upazila_id.val('').trigger('change');
      }
    });
  });
  /**
   * Load Union Ward
   * Load the corresponding Union Ward based on the Union Ward choice.
   * @return {mixed} Select field.
   * ---------------------------------------------------------------------
   */

  $('body').on('change', '#thana-upazila', function () {
    var thana_upazila_id = $(this).val();
    $.get(app.app_url + 'getUnionWard/' + thana_upazila_id, function (data) {
      var union_ward_id = $('#union-ward');

      if (union_ward_id.length > 0) {
        //success data
        union_ward_id.empty();
        union_ward_id.append('<option value="">' + app.label_select + '</option>');
        $.each(data, function (index, subcatObj) {
          union_ward_id.append('<option value="' + subcatObj.id + '">' + (subcatObj["name_".concat(app_locale)] ? subcatObj["name_".concat(app_locale)] : subcatObj.name_en) + '</option>');
        });
        /**
         * Trigger only for select2
         */

        union_ward_id.val('').trigger('change');
      }
    });
  });
  /**
   * Load District For Repeater
   * Load the corresponding District based on the Division choice using Repeater.
   * @return {mixed} Select field.
   * ---------------------------------------------------------------------
   */

  $('body').on('change', '.repeater-division', function () {
    var this_item = $(this);
    var division_id = this_item.val();
    $.get(app.app_url + 'getDistrict/' + division_id, function (data) {
      var district_id = this_item.parents('.repeat-this').find('.repeater-district');

      if (district_id.length > 0) {
        //success data
        district_id.empty();
        district_id.append('<option value="">' + app.label_select + '</option>');
        $.each(data, function (index, subcatObj) {
          district_id.append('<option value="' + subcatObj.id + '">' + (subcatObj["name_".concat(app_locale)] ? subcatObj["name_".concat(app_locale)] : subcatObj.name_en) + '</option>');
        });
        /**
         * Trigger only for select2
         */

        district_id.val('').trigger('change');
      }
    });
  });
  /**
   * Load Thana Upazila For Repeater
   * Load the corresponding Thana Upazila based on the District choice using Repeater.
   * @return {mixed} Select field.
   * ---------------------------------------------------------------------
   */

  $('body').on('change', '.repeater-district', function () {
    var this_item = $(this);
    var district_id = this_item.val();
    $.get(app.app_url + 'getThanaUpazila/' + district_id, function (data) {
      var thana_upazila_id = this_item.parents('.repeat-this').find('.repeater-thana-upazila');

      if (thana_upazila_id.length > 0) {
        //success data
        thana_upazila_id.empty();
        thana_upazila_id.append('<option value="">' + app.label_select + '</option>');
        $.each(data, function (index, subcatObj) {
          thana_upazila_id.append('<option value="' + subcatObj.id + '">' + (subcatObj["name_".concat(app_locale)] ? subcatObj["name_".concat(app_locale)] : subcatObj.name_en) + '</option>');
        });
        /**
         * Trigger only for select2
         */

        thana_upazila_id.val('').trigger('change');
      }
    });
  });
  /**
   * Load Union Ward For Repeater
   * Load the corresponding Union Ward based on the Union Ward choice using Repeater.
   * @return {mixed} Select field.
   * ---------------------------------------------------------------------
   */

  $('body').on('change', '.repeater-thana-upazila', function () {
    var this_item = $(this);
    var thana_upazila_id = this_item.val();
    $.get(app.app_url + 'getUnionWard/' + thana_upazila_id, function (data) {
      var union_ward_id = this_item.parents('.repeat-this').find('.repeater-union-ward');

      if (union_ward_id.length > 0) {
        //success data
        union_ward_id.empty();
        union_ward_id.append('<option value="">' + app.label_select + '</option>');
        $.each(data, function (index, subcatObj) {
          union_ward_id.append('<option value="' + subcatObj.id + '">' + (subcatObj["name_".concat(app_locale)] ? subcatObj["name_".concat(app_locale)] : subcatObj.name_en) + '</option>');
        });
        /**
         * Trigger only for select2
         */

        union_ward_id.val('').trigger('change');
      }
    });
  });
});

/***/ }),

/***/ "./resources/js/_application.js":
/*!**************************************!*\
  !*** ./resources/js/_application.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cms_repeater__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_cms-repeater */ "./resources/js/_cms-repeater.js");
/**
 * Application Javascripts
 *
 * All the javascripts associated with the application.
 */
// ------------------------------------------
// Get the application data in JavaScript.
// Coming from admin.blade.php
// ------------------------------------------
var app = jQuery.parseJSON(app_data);

jQuery(document).ready(function ($) {
  if ($('body').hasClass('common-labels')) {
    // ----------------------------
    // REDIRECT TO DATA TYPE
    // ----------------------------
    $('[name="data_type"]').on('change', function () {
      var parameter = $(this).val();
      var baseUrl = window.location.href;
      var withoutLastChunk = baseUrl.slice(0, baseUrl.lastIndexOf("common-labels"));
      window.location.href = withoutLastChunk + 'common-labels/' + parameter;
    });
  }

  if (window.jQuery().repeater) {
    // ----------------------------
    // MANAGE REPEATER FIELDS
    // ----------------------------
    //DAE-Demonstration
    _cms_repeater__WEBPACK_IMPORTED_MODULE_0__.default.repeat('#repeater-dae-supplied-equipment', app.repeater_dae_supplied_equipment, true);
    _cms_repeater__WEBPACK_IMPORTED_MODULE_0__.default.repeat('#repeater-dof-work-date-time', app.repeater_dof_work_date_time, true);
    _cms_repeater__WEBPACK_IMPORTED_MODULE_0__.default.repeat('#repeater-dae-participant-details', app.repeater_dae_participant_details, true);
    _cms_repeater__WEBPACK_IMPORTED_MODULE_0__.default.repeat('#repeater-soil-health-detail', app.repeater_soil_health_detail, true);
    _cms_repeater__WEBPACK_IMPORTED_MODULE_0__.default.repeat('#repeater-training-schedule-detail', app.repeater_training_schedule_details, true);
  }

  if (window.jQuery().areYouSure) {
    // ----------------------------
    // WARN USERS TO SAVE FORM DATA
    // ----------------------------
    $('form.needs-validation').areYouSure({
      'message': 'You have unsaved changes! Save them before leaving.'
    });
  }
});

/***/ }),

/***/ "./resources/js/_bootstrap-form-validation.js":
/*!****************************************************!*\
  !*** ./resources/js/_bootstrap-form-validation.js ***!
  \****************************************************/
/***/ (() => {

// ------------------------------------------
// Bootstrap Form Validation
// ------------------------------------------
var __check_form_validation = function __check_form_validation() {
  'use strict'; // Fetch all the forms we want to apply custom Bootstrap validation styles to

  var forms = document.getElementsByClassName('needs-validation');
  window.addEventListener('load', function () {
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);
    });
  }, false);
};

__check_form_validation();

/***/ }),

/***/ "./resources/js/_cms-repeater.js":
/*!***************************************!*\
  !*** ./resources/js/_cms-repeater.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * Class CMSRepeater
 *
 * All the methods specific to the Repeater associated with the CMS.
 */
var CMSRepeater = /*#__PURE__*/function () {
  function CMSRepeater() {
    _classCallCheck(this, CMSRepeater);
  }

  _createClass(CMSRepeater, null, [{
    key: "defaultFor",
    value:
    /**
    * Function: DefaultFor
    * @param  {string} arg Variable.
    * @param  {mixed}  val Default value.
    * @return {mixed}      The passed value or the default.
    * ...
    */
    function defaultFor(arg, val) {
      return typeof arg !== 'undefined' ? arg : val;
    }
  }, {
    key: "repeat",
    value: function repeat(element, data, initEmpty) {
      if (window.jQuery().repeater) {
        data = this.defaultFor(data, []);
        initEmpty = this.defaultFor(initEmpty, false);
        var repeater_item = $(element).repeater({
          initEmpty: initEmpty,
          show: function show() {
            var this_elem = $(this);
            this_elem.slideDown();
            this_elem.find('.form-control[required]').prop('required', true);

            if (window.jQuery().select2) {
              this_elem.find('.form-control.enable-select2').select2();
            }

            if (window.jQuery().datepicker) {
              this_elem.find('.datepicker').datepicker({
                format: 'dd-mm-yyyy'
              });
            }

            if (window.jQuery().datetimepicker) {
              var picker_format = this_elem.find('.datetimepicker').data('picker-format');
              picker_format = 'undefined' !== typeof picker_format ? picker_format : 'DD-MM-YYYY hh:mm A';
              this_elem.find('.datetimepicker').datetimepicker({
                format: picker_format,
                icons: {
                  time: 'icon-alarm',
                  date: 'icon-calendar2',
                  up: 'icon-chevron-up',
                  down: 'icon-chevron-down',
                  previous: 'icon-chevron-left',
                  next: 'icon-chevron-right',
                  today: 'icon-alarm-check',
                  clear: 'icon-trash-alt',
                  close: 'icon-cross3'
                }
              });
            }
          },
          hide: function hide(remove) {
            var this_elem = $(this);

            if (confirm('Are you sure, you want to delete the row?')) {
              this_elem.slideUp(remove);
            }
          }
        }); // Set data on edit mode

        if (typeof data !== 'undefined' && !$.isEmptyObject(data)) {
          repeater_item.setList(data);
        }
      }
    }
  }]);

  return CMSRepeater;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CMSRepeater);

/***/ }),

/***/ "./resources/js/_cms.js":
/*!******************************!*\
  !*** ./resources/js/_cms.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// ------------------------------------------
// Get the application data in JavaScript.
// Coming from admin.blade.php
// ------------------------------------------
var app = jQuery.parseJSON(app_data);
/**
 * Class CMS
 *
 * All the methods specific to the CMS noted here.
 */

var CMS = /*#__PURE__*/function () {
  function CMS() {
    _classCallCheck(this, CMS);
  }

  _createClass(CMS, null, [{
    key: "updateUserMeta",
    value: // Update User Meta Data.
    //
    // Using AJAX post method to store data in Database using
    // updateUserMeta() and deleteUserMeta() functions.
    // --------------------------------------------------
    function updateUserMeta(selector) {
      var forced_values = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : array();

      // Values from data attributes.
      var _user_id = selector.attr('data-user-id');

      var _meta_key = selector.attr('data-key');

      var _meta_value = selector.attr('data-value'); // Values from function parameters.


      var forced_user_id = forced_values.user_id;
      var forced_key = forced_values.key;
      var forced_value = forced_values.value;
      var id = '';
      var key = '';
      var value = '';

      if (typeof forced_values.user_id !== 'undefined') {
        id = forced_user_id;
      } else if (typeof _user_id !== 'undefined' && _user_id !== '') {
        id = _user_id;
      } else {
        console.error('User ID is not defined');
      }

      if (typeof forced_values.key !== 'undefined') {
        key = forced_key;
      } else if (typeof _meta_key !== 'undefined' && _meta_key !== '') {
        key = _meta_key;
      } else {
        console.error('Meta Key is not defined');
      }

      if (typeof forced_values.value !== 'undefined') {
        value = forced_value;
      } else if (typeof _meta_value !== 'undefined' && _meta_key !== '') {
        value = _meta_value;
      }

      var post_data = 'user_id=' + id + '&meta_key=' + key + '&meta_value=' + value;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        // TODO VistaCMS Framework Update Required
        url: app.app_url + 'users/meta/save',
        data: post_data
      }).done(function (msg) {
        if ('updated' == msg) {
          console.info('User meta data updated successfully!');
        } else if ('deleted' == msg) {
          console.warn('User meta data deleted successfully!');
        } else {
          console.error('There was an error updating User meta data');
        }
      });
    }
  }]);

  return CMS;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CMS);

/***/ }),

/***/ "./resources/js/_dashboard.js":
/*!************************************!*\
  !*** ./resources/js/_dashboard.js ***!
  \************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

// ------------------------------------------
// Get the application data in JavaScript.
// Coming from admin.blade.php
// ------------------------------------------
var app = jQuery.parseJSON(app_data);

if ((typeof c3 === "undefined" ? "undefined" : _typeof(c3)) === 'object') {
  c3.generate({
    bindto: '#chart-public-contents',
    data: {
      columns: app.dash_contents,
      type: 'donut'
    },
    color: {
      pattern: ['#1f77b4', '#17becf', '#9edae5', '#aec7e8', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#bcbd22', '#dbdb8d']
    },
    donut: {
      title: app.dash_total_label + " " + app.dash_total_count,
      label: {
        format: function format(value, ratio, id) {
          return d3.format('')(value);
        }
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/_sidebar.js":
/*!**********************************!*\
  !*** ./resources/js/_sidebar.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cms__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_cms */ "./resources/js/_cms.js");
// ------------------------------------------
// Get the application data in JavaScript.
// Coming from admin.blade.php
// ------------------------------------------
var app = jQuery.parseJSON(app_data);

jQuery(document).ready(function ($) {
  // ------------------------------------------
  // Make the Sidebar toggleable on Mobile viewports.
  // ------------------------------------------
  $('body').on('click', '.sidebar-toggle', function () {
    // Resolve sidebar toggle issue in mobile.
    if ($('body').hasClass('sidebar-mini')) {
      $('body').removeClass('sidebar-mini');
    }

    $('.sidebar').slideToggle();
  }); // ------------------------------------------
  // Sidebar Submenu toggle.
  // ------------------------------------------
  // Thanks to Limitless Admin Framework.
  // Define default class names and options.

  var navClass = 'sidebar';
  var navItemClass = 'nav-item';
  var navItemOpenClass = 'active';
  var navLinkClass = 'nav-link';
  var navSubmenuClass = 'submenu';
  var navSlidingSpeed = 250; // Configure collapsible functionality.

  $('.' + navClass).find('.' + navItemClass).has('.' + navSubmenuClass).children('.' + navItemClass + ' > ' + '.' + navLinkClass).not('.disabled').on('click', function (e) {
    e.preventDefault();
    var trigger = $(this);
    var navMini = $('.sidebar-mini').find('.' + navClass).find('.' + navItemClass); // Collapsible.

    if (trigger.parent('.' + navItemClass).hasClass(navItemOpenClass)) {
      trigger.parent('.' + navItemClass).not(navMini).removeClass(navItemOpenClass).children('.' + navSubmenuClass).slideUp(navSlidingSpeed);
    } else {
      trigger.parent('.' + navItemClass).not(navMini).addClass(navItemOpenClass).children('.' + navSubmenuClass).slideDown(navSlidingSpeed);
    } // Accordion: Close others when one is clicked.


    if ('accordion' === trigger.parents('.' + navClass).data('navtype')) {
      trigger.parent('.' + navItemClass).not(navMini).siblings(':has(.' + navSubmenuClass + ')').removeClass(navItemOpenClass).children('.' + navSubmenuClass).slideUp(navSlidingSpeed);
    }
  }); // ------------------------------------------
  // Mini Sidebar
  // Toggle on click.
  // ------------------------------------------

  $('#toggle-sidebar-mini').on('click', function (e) {
    e.preventDefault();
    var body = $('body');
    var toggle_sidebar_icon = $('.toggle-sidebar-icon');
    var toggle_label = $(this).find('span');

    if (body.hasClass('sidebar-mini')) {
      body.removeClass('sidebar-mini');
      toggle_sidebar_icon.removeClass('icon-circle-right2').addClass('icon-circle-left2');
      toggle_label.text(app.sidebar_collapse);
      _cms__WEBPACK_IMPORTED_MODULE_0__.default.updateUserMeta($(this), {
        key: '_sidebar_mini'
      }); // delete while value is empty
    } else {
      body.addClass('sidebar-mini');
      toggle_sidebar_icon.removeClass('icon-circle-left2').addClass('icon-circle-right2');
      toggle_label.text(app.sidebar_expand);
      _cms__WEBPACK_IMPORTED_MODULE_0__.default.updateUserMeta($(this), {
        key: '_sidebar_mini',
        value: true
      });
    }
  }); // Revert Bottom Menus.
  // Flip 2nd level if menu overflows the bottom edge of browser window.
  // Thanks to Limitless Admin Framework.

  $('.sidebar-mini').find('ul.nav').children('.has-submenu').hover(function () {
    var totalHeight = 0;
    var thisListItem = $(this);
    var navSubmenuClass = 'submenu';
    var navSubmenuReversedClass = 'submenu-reversed';
    totalHeight += thisListItem.find('.' + navSubmenuClass).filter(':visible').outerHeight();

    if (thisListItem.children('.' + navSubmenuClass).length) {
      if (thisListItem.children('.' + navSubmenuClass).offset().top + thisListItem.find('.' + navSubmenuClass).filter(':visible').outerHeight() > document.body.clientHeight) {
        thisListItem.addClass(navSubmenuReversedClass);
      } else {
        thisListItem.removeClass(navSubmenuReversedClass);
      }
    }
  });
});

/***/ }),

/***/ "./resources/js/_user-tweaks.js":
/*!**************************************!*\
  !*** ./resources/js/_user-tweaks.js ***!
  \**************************************/
/***/ (() => {

/**
 * Partial: User Tweaks
 *
 * Responsible for maintaining conditional fields
 * on the user add/edit and edit profile pages.
 */
jQuery(document).ready(function ($) {
  if ($('body.add-user, body.edit-user').length > 0) {
    var mandate_free_on_user_level = function mandate_free_on_user_level() {
      // District  – DDLG, DF
      // Upazilla   – UPS
      // Union  – UPS
      switch (user_level.val()) {
        case 'ups':
          mandate_division();
          mandate_district();
          mandate_upazila();
          mandate_union();
          break;

        case 'uno':
          mandate_division();
          mandate_district();
          mandate_upazila();
          free_union();
          break;

        case 'dc':
        case 'ddlg':
        case 'df':
          mandate_division();
          mandate_district();
          free_upazila();
          free_union();
          break;

        case 'dv':
          mandate_division();
          free_district();
          free_upazila();
          free_union();
          break;

        default:
          free_division();
          free_district();
          free_upazila();
          free_union();
          break;
      }
    }; // Active on load.


    var user_level = $('#user-level');
    var division_label = $('.js-conditional-req-division');
    var district_label = $('.js-conditional-req-district');
    var upazila_label = $('.js-conditional-req-upazila');
    var union_label = $('.js-conditional-req-union');
    var division_field = $('#division');
    var district_field = $('#district');
    var upazila_field = $('#thana-upazila');
    var union_field = $('#union-ward');

    var mandate_division = function mandate_division() {
      division_label.show();
      division_field.prop('required', true);
    };

    var free_division = function free_division() {
      division_label.hide();
      division_field.removeAttr('required');
    };

    var mandate_district = function mandate_district() {
      district_label.show();
      district_field.prop('required', true);
    };

    var free_district = function free_district() {
      district_label.hide();
      district_field.removeAttr('required');
    };

    var mandate_upazila = function mandate_upazila() {
      upazila_label.show();
      upazila_field.prop('required', true);
    };

    var free_upazila = function free_upazila() {
      upazila_label.hide();
      upazila_field.removeAttr('required');
    };

    var mandate_union = function mandate_union() {
      union_label.show();
      union_field.prop('required', true);
    };

    var free_union = function free_union() {
      union_label.hide();
      union_field.removeAttr('required');
    };

    mandate_free_on_user_level(); // Active on change.
    // TRIED REALLY HARD TO NOT REPEAT. BUT COULDN'T MAKE IT WORK IN A SINGLE FUNCTION. :(

    $('#user-level').on('change', function () {
      {
        // District  – DDLG, DF
        // Upazilla   – UPS
        // Union  – UPS
        switch ($(this).val()) {
          case 'ups':
            mandate_division();
            mandate_district();
            mandate_upazila();
            mandate_union();
            break;

          case 'uno':
            mandate_division();
            mandate_district();
            mandate_upazila();
            free_union();
            break;

          case 'dc':
          case 'ddlg':
          case 'df':
            mandate_division();
            mandate_district();
            free_upazila();
            free_union();
            break;

          case 'dv':
            mandate_division();
            free_district();
            free_upazila();
            free_union();
            break;

          default:
            free_division();
            free_district();
            free_upazila();
            free_union();
            break;
        }
      }
    });
  }
});

/***/ }),

/***/ "./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js":
/*!************************************************************************!*\
  !*** ./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js ***!
  \************************************************************************/
/***/ (function(module) {

/*!
 * bsCustomFileInput v1.3.4 (https://github.com/Johann-S/bs-custom-file-input)
 * Copyright 2018 - 2020 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-file-input/blob/master/LICENSE)
 */
(function (global, factory) {
   true ? module.exports = factory() :
  0;
}(this, (function () { 'use strict';

  var Selector = {
    CUSTOMFILE: '.custom-file input[type="file"]',
    CUSTOMFILELABEL: '.custom-file-label',
    FORM: 'form',
    INPUT: 'input'
  };

  var textNodeType = 3;

  var getDefaultText = function getDefaultText(input) {
    var defaultText = '';
    var label = input.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      defaultText = label.textContent;
    }

    return defaultText;
  };

  var findFirstChildNode = function findFirstChildNode(element) {
    if (element.childNodes.length > 0) {
      var childNodes = [].slice.call(element.childNodes);

      for (var i = 0; i < childNodes.length; i++) {
        var node = childNodes[i];

        if (node.nodeType !== textNodeType) {
          return node;
        }
      }
    }

    return element;
  };

  var restoreDefaultText = function restoreDefaultText(input) {
    var defaultText = input.bsCustomFileInput.defaultText;
    var label = input.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      var element = findFirstChildNode(label);
      element.textContent = defaultText;
    }
  };

  var fileApi = !!window.File;
  var FAKE_PATH = 'fakepath';
  var FAKE_PATH_SEPARATOR = '\\';

  var getSelectedFiles = function getSelectedFiles(input) {
    if (input.hasAttribute('multiple') && fileApi) {
      return [].slice.call(input.files).map(function (file) {
        return file.name;
      }).join(', ');
    }

    if (input.value.indexOf(FAKE_PATH) !== -1) {
      var splittedValue = input.value.split(FAKE_PATH_SEPARATOR);
      return splittedValue[splittedValue.length - 1];
    }

    return input.value;
  };

  function handleInputChange() {
    var label = this.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      var element = findFirstChildNode(label);
      var inputValue = getSelectedFiles(this);

      if (inputValue.length) {
        element.textContent = inputValue;
      } else {
        restoreDefaultText(this);
      }
    }
  }

  function handleFormReset() {
    var customFileList = [].slice.call(this.querySelectorAll(Selector.INPUT)).filter(function (input) {
      return !!input.bsCustomFileInput;
    });

    for (var i = 0, len = customFileList.length; i < len; i++) {
      restoreDefaultText(customFileList[i]);
    }
  }

  var customProperty = 'bsCustomFileInput';
  var Event = {
    FORMRESET: 'reset',
    INPUTCHANGE: 'change'
  };
  var bsCustomFileInput = {
    init: function init(inputSelector, formSelector) {
      if (inputSelector === void 0) {
        inputSelector = Selector.CUSTOMFILE;
      }

      if (formSelector === void 0) {
        formSelector = Selector.FORM;
      }

      var customFileInputList = [].slice.call(document.querySelectorAll(inputSelector));
      var formList = [].slice.call(document.querySelectorAll(formSelector));

      for (var i = 0, len = customFileInputList.length; i < len; i++) {
        var input = customFileInputList[i];
        Object.defineProperty(input, customProperty, {
          value: {
            defaultText: getDefaultText(input)
          },
          writable: true
        });
        handleInputChange.call(input);
        input.addEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i = 0, _len = formList.length; _i < _len; _i++) {
        formList[_i].addEventListener(Event.FORMRESET, handleFormReset);

        Object.defineProperty(formList[_i], customProperty, {
          value: true,
          writable: true
        });
      }
    },
    destroy: function destroy() {
      var formList = [].slice.call(document.querySelectorAll(Selector.FORM)).filter(function (form) {
        return !!form.bsCustomFileInput;
      });
      var customFileInputList = [].slice.call(document.querySelectorAll(Selector.INPUT)).filter(function (input) {
        return !!input.bsCustomFileInput;
      });

      for (var i = 0, len = customFileInputList.length; i < len; i++) {
        var input = customFileInputList[i];
        restoreDefaultText(input);
        input[customProperty] = undefined;
        input.removeEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i2 = 0, _len2 = formList.length; _i2 < _len2; _i2++) {
        formList[_i2].removeEventListener(Event.FORMRESET, handleFormReset);

        formList[_i2][customProperty] = undefined;
      }
    }
  };

  return bsCustomFileInput;

})));
//# sourceMappingURL=bs-custom-file-input.js.map


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _bootstrap_form_validation__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_bootstrap-form-validation */ "./resources/js/_bootstrap-form-validation.js");
/* harmony import */ var _bootstrap_form_validation__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_bootstrap_form_validation__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _sidebar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_sidebar */ "./resources/js/_sidebar.js");
/* harmony import */ var _dashboard__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_dashboard */ "./resources/js/_dashboard.js");
/* harmony import */ var _dashboard__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_dashboard__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _application_locations__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./_application-locations */ "./resources/js/_application-locations.js");
/* harmony import */ var _application_locations__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_application_locations__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _application__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./_application */ "./resources/js/_application.js");
/* harmony import */ var bs_custom_file_input__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! bs-custom-file-input */ "./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js");
/* harmony import */ var bs_custom_file_input__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(bs_custom_file_input__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _user_tweaks__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./_user-tweaks */ "./resources/js/_user-tweaks.js");
/* harmony import */ var _user_tweaks__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_user_tweaks__WEBPACK_IMPORTED_MODULE_6__);
/**
 * ------------------------------------------------------------
 * Admin end
 * ------------------------------------------------------------
 *
 * JavaScripts specific to the admin end of the Application.
 *
 * Get the compiled file under:
 * public/js/admin.js
 * ------------------------------------------------------------
 */
// ------------------------------------------
// Get the application data in JavaScript.
// Coming from admin.blade.php
// ------------------------------------------
var app = JSON.parse(app_data);






 // import * as cookies from './_cookie.js';

jQuery(function ($) {
  $('html').removeClass('no-js').addClass('js'); // ----------------------------
  // PLUGIN INITIATIONS
  // ----------------------------

  bs_custom_file_input__WEBPACK_IMPORTED_MODULE_5___default().init(); // ----------------------------
  // Pass the CSRF Token for AJAX.
  // ----------------------------

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); // ------------------------------------------
  // Select2
  // ------------------------------------------

  if (window.jQuery().select2) {
    var select2_elem = $('.enable-select2');

    if (select2_elem.length > 0) {
      select2_elem.select2();
    }
  } // ------------------------------------------
  // Tooltip
  // using: Bootstrap tooltip
  // ------------------------------------------


  if (window.jQuery().tooltip) {
    $('[data-toggle="tooltip"]').tooltip();
  } // ------------------------------------------
  // Grid Pagination.
  // Set items per page to the URL.
  // ------------------------------------------


  var items_per_page = $('#items-per-page');

  if (items_per_page.length > 0) {
    items_per_page.on('change', function () {
      if (history.pushState) {
        var params = new URLSearchParams(window.location.search); // Set items per page to the URL.

        params.set('ipp', $(this).val()); // Remove 'page' parameter [to deactivate pagination] as it displays no result found in increased items per page.

        params["delete"]('page'); // Build the new URL.

        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params.toString();
        window.history.pushState({
          path: newUrl
        }, '', newUrl); // Redirect to the new URL.

        window.location.href = newUrl;
      }
    });
  } // ------------------------------------------
  // DatePicker
  // ------------------------------------------


  if (window.jQuery().datepicker) {
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy'
    }); // $('.datepicker-trigger').on('click', function() {
    //     $(this).parents('.input-group').find('.form-control').datepicker({
    //         format: 'dd-mm-yyyy'
    //     });
    // });

    $('.monthpicker').datepicker({
      format: 'mm'
    });
    $('.monthyearpicker').datepicker({
      format: 'mm-yyyy'
    });
    $('.yearpicker').datepicker({
      format: 'yyyy'
    });
  } // ------------------------------------------
  // DateTimePicker
  // using: Bootstrap DateTimePicker
  // @link https://github.com/technovistalimited/bootstrap4-datetimepicker
  // ------------------------------------------


  if (window.jQuery().datetimepicker) {
    $('.datetimepicker').datetimepicker({
      format: 'DD-MM-YYYY hh:mm A',
      icons: {
        time: 'icon-alarm',
        date: 'icon-calendar2',
        up: 'icon-chevron-up',
        down: 'icon-chevron-down',
        previous: 'icon-chevron-left',
        next: 'icon-chevron-right',
        today: 'icon-alarm-check',
        clear: 'icon-trash-alt',
        close: 'icon-cross3'
      }
    });
  } // ----------------------------
  // ROLES: CHANGE URL BASED ON SELECTION
  // ----------------------------


  if ($('body').hasClass('roles')) {
    $('[name="role"]').on('change', function () {
      var parameter = $(this).val();
      var baseUrl = window.location.href;
      var withoutLastChunk = baseUrl.slice(0, baseUrl.lastIndexOf("roles"));
      window.location.href = withoutLastChunk + 'roles/' + parameter;
    });
  } // ----------------------------
  // COMMON SETUPS: CHANGE URL BASED ON SELECTION
  // ----------------------------


  if ($('body').hasClass('common-setups')) {
    $('[name="data_type"]').on('change', function () {
      var parameter = $(this).val();
      var baseUrl = window.location.href;
      var withoutLastChunk = baseUrl.slice(0, baseUrl.lastIndexOf("setups"));
      window.location.href = withoutLastChunk + 'setups/' + parameter;
    });
  } // ----------------------------
  // CHANGE USER PASSWORD FIELDS TOGGLER
  // ----------------------------


  var change_password_btn = $('#change-password');
  var user_password_block = $('.user-password-block');
  change_password_btn.on('click', function () {
    change_password_btn.hide();
    user_password_block.show();
    user_password_block.find('#password').focus();
  });
  var capabilities_table = $('.table-capabilities');

  if (capabilities_table.length > 0) {
    // ----------------------------
    // USER CAPABILITIES CHECK/UNCHECK ALL
    // ----------------------------
    $('#check-all').on('click', function () {
      $('.caps-checkboxes').prop('checked', true);
    });
    $('#uncheck-all').on('click', function () {
      $('.caps-checkboxes').prop('checked', false);
    });
  } // ----------------------------
  // ACTIVATE TAB ON URL HASH.
  // @author dubbe
  // @link   https://stackoverflow.com/a/9393768/1743124
  // ----------------------------


  var options_page = $('body.settings');

  if (options_page.length > 0) {
    var url = document.location.toString();
    var prefix = 'tab_'; // Set the tab active, that has the has in the URL.

    if (url.match('#')) {
      var tab = url.split('#')[1].replace(prefix, '');
      $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    } // Set currently active tab info on URL as a Hash.


    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      window.location.hash = e.target.hash.replace('#', '#' + prefix);
    });
  } // ----------------------------
  // EMPTY FORM (apart from RESET)
  // ----------------------------
  // Clear and Reload Page from within the form.


  $('body').on('click', '.btn-clear-filter', function () {
    var this_form = $(this).parents('form');
    this_form.find('.form-control').val('').attr('value', '').trigger('change');
    this_form.find('.custom-select').val('').trigger('change'); // Load the page without parameters.

    window.location.href = window.location.href.split('?')[0];
  }); // Clear and Reload Page from outside the form.

  $('body').on('click', '.btn-clear-filter-outside', function (event) {
    event.preventDefault();
    var this_form = $(this).closest('form');
    this_form.find('.form-control').val('').attr('value', '').trigger('change');
    this_form.find('.custom-select').val('').trigger('change'); // Load the page without parameters.

    window.location.href = window.location.href.split('?')[0];
  }); // Clear but DON'T RELOAD Page.

  $('body').on('click', '.btn-clear-filter-no-reload', function () {
    var this_form = $(this).parents('form');
    this_form.find('.form-control').val('').attr('value', '').trigger('change');
    this_form.find('.custom-select').val('').trigger('change'); // hard coded for report checkbox buttons for columns.

    this_form.find('.btn-checkbox').addClass('active');
  }); // ----------------------------
  // RESET FORM (apart from empty)
  // Only for Select2
  // ----------------------------

  $('body').on('click', 'button[type="reset"]', function () {
    $(this).parents('form').find('.enable-select2').trigger('change');
  }); // ----------------------------
  // Submit Report form on 'Enter' keyup.
  // ----------------------------
  // Execute when the user releases a key on the keyboard

  var report_btn = $('.btn-sm.report-trigger');

  if (report_btn.length > 0) {
    document.addEventListener('keyup', function (event) {
      // Number 13 is the "Enter" key on the keyboard.
      if (13 === event.keyCode) {
        // Submit the report filtering form.
        report_btn.click();
      }
    });
  }
  /**
   * Match the Heights.
   * using jQuery MatchHeight library.
   * -------------------------------------------------
   */


  if (window.jQuery().matchHeight) {
    var matchHeightElem = $('.match-height');

    if (matchHeightElem.length > 0) {
      matchHeightElem.matchHeight();
    }
  }
});
})();

/******/ })()
;