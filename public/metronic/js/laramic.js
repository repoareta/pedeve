var Laramic = function () {
  var mainContent = '#l-content';
  var block = $('#kt_content');
  var previousUrl = window.location.href;

  var handleSidebarMenu = function() {
    $('.kt-menu__link.shoot').click(function (){
      $('.kt-menu__item.kt-menu__item--active').removeClass('kt-menu__item--active');
      $(this).closest('.kt-menu__item').addClass('kt-menu__item--active');
    });
  }

  var handleAjaxLink = function () {
    // semua class .shoot akan di anggap ajax link
    $('a.shoot').click(function (e) {

      if (!$(mainContent)) return;

      e.preventDefault();
      var url = this.href;

      if (previousUrl === url)
        return false;

      history.pushState(null, null, url);
      loadAjax(url);

    });

    $(window).bind('popstate', function () {
      var url = location.href;

      loadAjax(url);

    });
  }

  var handleAjaxModal = function () {
    $('a.shoot-modal').unbind('click').click(function (e) {
      e.preventDefault();

      var modalContent = $('#shoot-modal .modal-content');
      if (!$(modalContent)) return;

      var options = $(this).data();
      var size = options.size || 'lg';
      var url = this.href;

      $('#shoot-modal .modal-dialog')
        .removeClass('modal-sm modal-md modal-lg modal-xl')
        .addClass('modal-' + size);

      loadAjax(url, { content: modalContent, block: block, history: false }).then(function () {
        $('#shoot-modal').modal('show');
      });

    });
  }

  var loadAjax = function (url, options) {
    options = $.extend(true, {
      content: mainContent,
      block: block,
      history: true,
      message: 'Loading...'
    }, options);

    var pageContent = $(options.content);

    if (options.history)
      previousUrl = url;

    KTApp.block(options.block, {
      overlayColor: '#000000',
      type: 'v2',
      state: 'success',
      message: options.message
    });

    return $.ajax({
      type: "GET",
      cache: false,
      url: url,
      dataType: "html",
      success: function (response) {
        KTApp.unblock(options.block);
        pageContent.html(response);
      },
      error: function (response) {
        KTApp.unblock(options.block);
        toastr.error('Halaman gagal dimuat.');
        if(response.status == 401){
          window.location = baseUrl + 'login';
        }
      }
    });
  }

  var initDefaultSelect2 = function () {
    $('.modal select').css('width', '100%');
    $('.select-select2').select2({
      placeholder: $(this).attr('placeholder'),
      minimumResultsForSearch: -1
    });
  }

  var initDefaultDatepicker = function () {
    $('.input-datepicker').datepicker({
      format: 'dd MM yyyy'
    });
  }

  var initActionButton = function () {

    $('.btn-edit').unbind('click').click(function (event) {
      event.preventDefault();
      loadAjax(this.getAttribute('href'), { content: $('#shoot-modal .modal-content'), block: $('#kt_content'), history: false }).then(function () {
        $('#shoot-modal').modal('show');
      });
    });

    $('.btn-delete').unbind('click').click(function (event) {
      event.preventDefault();
      var self = this

      swal.fire({
        title: "Anda yakin?",
        text: "Data akan dihapus",
        type: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonClass: "btn btn-danger",
        cancelButtonClass: "btn btn-outline-secondary",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return $.post(self.getAttribute('href'), { _method: 'DELETE' })
        }
      }).then(function (result) {
        if (!result.value) return false
        if (result.value && result.value.success) {
          swal.fire(
            'Dihapus!',
            'Data telah dihapus.',
            'success'
          )

          var url = $(self).data('url')
          if(url) loadAjax(url);

        } else {
          swal.fire(
            'Gagal!',
            'Data gagal dihapus.',
            'error'
          )
        }
      });

    })
  }

  return {
    init: function () {
      Laramic.initComponent();
      handleSidebarMenu();
    },

    initAjax: function () {
      Laramic.initComponent();
    },

    initComponent: function () {
      handleAjaxLink();
      handleAjaxModal();
      initDefaultSelect2();
      initDefaultDatepicker();
      initActionButton();
    },

    initWilayah: function () {
      Laramic.select2('.select2-provinsi', {
        url: baseUrl + 'select/provinsi',
        minimumInputLength: 0
      });

      if(provinsi_id = $('.select2-provinsi').val()){
        Laramic.select2('.select2-kota', {
          url: baseUrl + 'select/kota/' + provinsi_id,
          minimumInputLength: 0
        });
      }

      $('.select2-provinsi').on('select2:select', function (event) {
        var provinsi_id = event.target.value
        $('.select2-kota').attr('disabled', false);
        $('.select2-kota').val('').trigger('change');
        Laramic.select2('.select2-kota', {
          url: baseUrl + 'select/kota/' + provinsi_id,
          minimumInputLength: 0
        });
      });
    },

    initValidate: function (target, options) {
      var $el = $(target);
      var $buttonSubmit = $(".btn-submit");

      options = $.extend(true, {
        rules: {},
        invalidHandler: function (event, validator) {
          KTUtil.scrollTop();
        },
        submitHandler: function (form) {
          var optionsAjax = {
            data: $el.serialize(),
            dataType: 'json',
            success: function (result) {
              if (!result.success) toastr.error(result.message)
              toastr.success(result.message)

              if (options.datatable)
                options.datatable.ajax.reload(null, true)

              if (options.modal)
                $(options.modal).modal('hide');

              if (options.contentReload)
                loadAjax(options.contentReload)

            },
            error: function (error) {
              toastr.error(error.message)
            }
          }

          $buttonSubmit.attr('disabled', true);
          $buttonSubmit.addClass('kt-spinner kt-spinner--md kt-spinner--light');
          $buttonSubmit.text('Menyimpan');

          $el.ajaxSubmit(optionsAjax);
        },
        modal: false
      }, options);

      $el.validate({
        rules: options.rules,
        invalidHandler: options.invalidHandler,
        submitHandler: options.submitHandler
      });
    },

    initTable: function (target, options) {
      var $el = $(target);
      options = $.extend(true, {
        url: '',
        columns: [],
        order: []
      }, options);

      var table = $el.DataTable({
        serverSide: true,
        processing: true,
        scrollX: true,
        searching: false,
        ajax: options.url,
        columns: options.columns,
        order: options.order,
        drawCallback: function () {
          KTApp.initTooltips();

          $('.action-edit').click(function (event) {
            event.preventDefault();
            loadAjax(this.getAttribute('href'), { content: $('#shoot-modal .modal-content'), block: $('#kt_content'), history: false }).then(function () {
              $('#shoot-modal').modal('show');
            });
          });

          $('.action-delete').click(function (event) {
            event.preventDefault();
            var self = this

            swal.fire({
              title: "Anda yakin?",
              text: "Data akan dihapus",
              type: "warning",
              showCancelButton: true,
              buttonsStyling: false,
              confirmButtonClass: "btn btn-danger",
              cancelButtonClass: "btn btn-outline-secondary",
              confirmButtonText: "Ya, Hapus!",
              cancelButtonText: "Batal",
              showLoaderOnConfirm: true,
              preConfirm: () => {
                return $.post(self.getAttribute('href'), { _method: 'DELETE' })
              }
            }).then(function (result) {
              if (!result.value) return false
              if (result.value && result.value.success) {
                swal.fire(
                  'Dihapus!',
                  'Data telah dihapus.',
                  'success'
                )
                table.ajax.reload(null, true);
              } else {
                swal.fire(
                  'Gagal!',
                  'Data gagal dihapus.',
                  'error'
                )
              }
            });


          })
        }
      });

      return table;
    },

    select2: function (target, options) {

      var templateResult = function (result) {
        return result.text;
      }

      var $el = $(target);
      var $p = $(target).parent();

      options = $.extend(true, {
        placeholder: 'Search',
        url: '',
        minimumInputLength: 1,
        templateResult: templateResult,
        templateSelection: templateResult,
        allowClear: true,
        dropdownParent: $p
      }, options);

      $el.select2({
        placeholder: options.placeholder,
        allowClear: options.allowClear,
        dropdownParent: options.dropdownParent,
        ajax: {
          url: options.url,
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              keyword: params.term
            };
          },
          processResults: function (data) {
            return {
              results: data.items
            }
          },
          cache: true
        },
        escapeMarkup: function (markup) {
          return markup;
        },
        minimumInputLength: options.minimumInputLength,
        templateResult: options.templateResult, // omitted for brevity, see the source of this page
        templateSelection: options.templateSelection // omitted for brevity, see the source of this page
      });

    },
  }
}();

jQuery(document).ready(function () {
  Laramic.init(); // init metronic core componets
});