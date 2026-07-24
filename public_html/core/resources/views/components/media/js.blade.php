
@php
$type = $type ?? 'admin';
$trash_icon =  $type === 'admin' ? 'ti-trash' : 'las la-trash';
$check_icon =  $type === 'admin' ? 'fas fa-check' : 'las la-check';
$spinner_icon =  $type === 'admin' ? 'fas fa-spinner fa-spin' : 'fa-spin las la-spinner';
@endphp

<script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
<script>
    (function ($) {
        "use strict";
        var mainUploadBtn = '';
        //after select image
        $(document).on('click','.media_upload_modal_submit_btn',function (e) {
            e.preventDefault();
            var allData = $('.media-uploader-image-list li.selected');
            if( typeof allData != 'undefined'){
                mainUploadBtn.parent().find('.img-wrap').html('');
                var imageId = '';
                $.each(allData,function(index,value){
                    var el = $(this).data();
                    var separator = allData.length == index ? '' : '|';
                    imageId += el.imgid + separator;
                    mainUploadBtn.prev('input').attr('data-imgsrc',el.imgsrc);
                    mainUploadBtn.parent().find('.img-wrap').append('<div class="img-inner-wrap"><div class="rmv-span" data-imageid='+el.imgid+'><i class="{{$trash_icon}}"></i></div><div class="attachment-preview"><div class="thumbnail"><div class="centered"><img src="'+el.imgsrc+'"></div></div></div></div>');
                });
                 mainUploadBtn.prev('input').val(imageId.substring(0,imageId.length -1));

            }
            $('#media_upload_modal').modal('hide');

            mainUploadBtn.text('Change Image');
            mainUploadBtn.attr('data-image-ids', imageId.substring(0,imageId.length -1));
        });


        //delete image form media uploader
        $(document).on('click','.media_library_image_delete_btn',function (e) {
            e.preventDefault();

            var type = $(this).data('type');

            Swal.fire({
                title: '{{__("Are you sure to delete this image")}}',
                text: '{{__("This image will remove permanently")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__("Yes, Delete It")}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteImage(type);
                }
            });
        });
        function deleteImage(type){
            $.ajax({
                type: "POST",
                url: "{{route($type.'.upload.media.file.delete') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    img_id : $('.image_id').text(),
                    type : type,
                },
                success: function (data) {
                    $('.media-uploader-image-info a,.media-uploader-image-info .img-meta').hide();
                    $('.media-uploader-image-list li.selected').remove();
                    $('.media-uploader-image-info .img-wrapper img').attr('src','');
                    $('.media-uploader-image-info .img-info .img-title').text('');
                },
                error: function (error) {

                }
            });
        }


        $(document).on('click','.media_upload_form_btn',function (e) {
            e.preventDefault();

            var parent = $('#media_upload_modal');
            var loadAllImage = $('#load_all_media_images');
            var el = $(this);
            var imageId = el.prev('input').val();
            mainUploadBtn = el;

            parent.find('.media_upload_modal_submit_btn').text(el.data('btntitle'));
            parent.find('.media_upload_modal_submit_btn').attr('data-inputname',$(this).prev('input').attr('name'));
            parent.find('.modal-title').text(el.data('modaltitle'));

            if(el.data('mulitple')){
                parent.attr('data-mulitple','true')
            }else{
                parent.removeAttr('data-mulitple');
            }

            loadAllImage.attr('data-selectedimage','');
            if(imageId =! ''){
                loadAllImage.attr('data-selectedimage',el.prev('input').val());
                loadAllImage.trigger('click');
            }
        });

        $('body').on('click', '.media-uploader-image-list > li', function (e) {
            e.preventDefault();
            var el = $(this);
            var allData = el.data();

            if( typeof $('#media_upload_modal').attr('data-mulitple') == 'undefined'){
                el.toggleClass('selected').siblings().removeClass('selected');
            }else{
                el.toggleClass('selected');
            }

            $('.media-uploader-image-info a,.media-uploader-image-info .img-meta,.delete_image_form').show();

            var parent = $('.img-meta');
            parent.children('.date').text(allData.date);
            parent.children('.dimension').text(allData.dimension);
            parent.children('.size').text(allData.size);
            parent.children('.imgsrc').text(allData.imgsrc);
            parent.children('.image_id').text(allData.imgid);
            parent.find('input[name="img_alt_tag"]').val(allData.alt);
            parent.parent().find('input[name="img_id"]').val(allData.imgid);

            $('.img_alt_submit_btn').html('<i class="{{$check_icon}}"></i>');
            $('.img-info .img-title').text(allData.title)
            $('.media-uploader-image-info .img-wrapper img').attr('src',allData.imgsrc);
        });

        Dropzone.options.placeholderfForm = {
            dictDefaultMessage: "{{__('Drag or Select Your Image')}}",
            maxFiles: 50,
            maxFilesize: 10, //MB
            acceptedFiles: 'image/*',
            success: function (file, response) {
                if (file.previewElement) {
                    file.previewElement.classList.add("dz-success");
                }
                var imageId = response.id;
                var imgUrl = response.img_url;
                if (!imageId || !imgUrl) return;

                var isMultiple = typeof $('#media_upload_modal').attr('data-mulitple') !== 'undefined';
                var $input = mainUploadBtn.prev('input');
                var $imgWrap = mainUploadBtn.parent().find('.img-wrap');

                if (isMultiple) {
                    var currentVal = $input.val();
                    var newVal = currentVal ? currentVal + '|' + imageId : String(imageId);
                    $input.val(newVal);
                } else {
                    $imgWrap.html('');
                    $input.val(imageId);
                }

                // Locate the sibling "cover" (featured image) hidden input, if this upload
                // originated from the gallery block. The cover block is visually hidden
                // (see .cover-image-wrapper) but its hidden input still drives the backend payload.
                var $coverWrapper = mainUploadBtn.closest('.right-sidebar, form').find('.cover-image-wrapper');
                var $coverInput = $coverWrapper.find('input[type="hidden"]').first();
                var isCoverBlock = mainUploadBtn.closest('.cover-image-wrapper').length > 0;

                var isCoverImage = false;
                if (isCoverBlock) {
                    // Direct cover upload (legacy path, block is hidden but still functional)
                    isCoverImage = true;
                } else if (isMultiple && $coverInput.length && $coverInput.val() === '') {
                    // Auto-select: first gallery image becomes the cover when none is set yet
                    $coverInput.val(imageId);
                    isCoverImage = true;
                }

                var coverBadge = isCoverImage
                    ? '<span class="cover-badge badge bg-primary position-absolute" style="top:4px;left:4px;z-index:2;">{{__("Kapak")}}</span>'
                    : '';
                var coverBtnClass = isCoverImage ? 'make-cover-btn active-cover' : 'make-cover-btn';

                var $newThumb = $(
                    '<div class="img-inner-wrap position-relative"' + (isMultiple ? ' draggable="true"' : '') + '>' +
                    '<div class="rmv-span" data-imageid="' + imageId + '"><i class="{{$trash_icon}}"></i></div>' +
                    coverBadge +
                    (isMultiple ? '<button type="button" class="' + coverBtnClass + '" data-id="' + imageId + '" title="{{__("Kapak Yap")}}"><i class="las la-star"></i></button>' : '') +
                    '<div class="attachment-preview"><div class="thumbnail"><div class="centered">' +
                    '<img src="' + imgUrl + '">' +
                    '</div></div></div></div>'
                );

                $imgWrap.append($newThumb);
                togglePlaceholderVisibility($imgWrap);

                mainUploadBtn.text('{{__("Change Image")}}');
            },


            queuecomplete: function () {
                $('#media_upload_modal').modal('hide');
            },
            error: function (file, message) {
                if (file.previewElement) {
                    file.previewElement.classList.add("dz-error");
                    if ((typeof message !== "String") && message.error) {
                        message = message.error;
                    }
                    for (let node of file.previewElement.querySelectorAll("[data-dz-errormessage]")) {
                        node.textContent = message.errors.file[0];
                    }
                }
            }
        };


        $(document).on('click', '#upload_media_image', function (e) {
            e.preventDefault();
            $('.media_upload_modal_submit_btn').hide();
        });


        $(document).on('click', '#load_all_media_images', function (e) {
            e.preventDefault();
            loadAllImages();
        });
        $(document).on('click', '.img_alt_submit_btn', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent().parent();
            var alt = $(this).prev('input').val();
            var imgId = parent.find('.image_id').text();

            $.ajax({
                type: "POST",
                url: "{{ route($type.'.upload.media.file.alt.change')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    imgid: parseInt(imgId),
                    alt: alt
                },
                success: function (data) {
                    $('.img_alt_submit_btn').html('<i class="{{$check_icon}}"></i>');
                    $('.media-uploader-image-list li[data-imgid="'+imgId+'"]').data('alt',alt);
                }
            });
        });
        function arrayRemove(arr, value) {

            return arr.filter(function(ele){
                return ele != value;
            });
        }

        // Toggle the default placeholder image/icon inside a gallery's .img-wrap.
        // If any .img-inner-wrap thumbnails exist, the placeholder (a direct-child
        // <img> of .img-wrap, not wrapped in .img-inner-wrap) is hidden; otherwise
        // it is restored to its default display state.
        function togglePlaceholderVisibility($imgWrap) {
            if (!$imgWrap || !$imgWrap.length) return;
            var $placeholder = $imgWrap.children('img');
            var hasThumbnails = $imgWrap.find('.img-inner-wrap').filter(function () {
                return $(this).is(':visible');
            }).length > 0;

            if (hasThumbnails) {
                $placeholder.hide();
            } else {
                $placeholder.show();
            }
        }

        $(document).on('click','.media-upload-btn-wrapper .img-wrap > .rmv-span,.media-upload-btn-wrapper .img-wrap .img-inner-wrap > .rmv-span',function (e) {
            //imlement remove image icon
            var el = $(this);
            let parentClass = el.parent().attr('class');
            let $removedThumb = el.parent(); // the .img-inner-wrap being removed (if applicable)
            let $galleryWrapper = el.closest('.media-upload-btn-wrapper');
            let removedImageId = el.data('imageid') ? String(el.data('imageid')) : null;

            if( parentClass === 'img-inner-wrap'){
                let button = el.parent().parent().parent().find('.media_upload_form_btn');
                let value = el.parent().parent().parent().find('input[type="hidden"]').val();

                el.parent().hide();
                //work on remove only the remove item
                if(el.parent().parent().find('.img-inner-wrap').length > 1){
                    let oldValue = el.parent().parent().parent().find('input[type="hidden"]').val('');
                    let currentImageId = '';
                    let newValue = '';

                    if (button.data('mulitple') != undefined){
                        let oldImageId = el.data('imageid');
                        let allImageArry = value.split('|');

                        let result  = arrayRemove(allImageArry,oldImageId);
                        allImageArry = result;
                        el.parent().parent().parent().find('input[type="hidden"]').val(allImageArry.join("|"));
                        el.parent().parent().parent().find('.media_upload_form_btn').attr('data-imgid',allImageArry.join("|"));
                    }

                }else {
                    el.parent().parent().parent().find('input[type="hidden"]').val('');
                    el.parent().parent().parent().find('.media_upload_form_btn').attr('data-imgid','');
                }

            }else {
                el.parent().parent().find('.attachment-preview').html('');
                el.parent().parent().parent().find('input[type="hidden"]').val('');
                el.parent().parent().parent().find('.media_upload_form_btn').attr('data-imgid','');
            }
            //check if this coming from -img-inner-wrap or not

            el.hide();

            // ---- Deletion Failsafe: reassign cover if the deleted image was the current cover ----
            if (removedImageId) {
                var $coverWrapper = $galleryWrapper.closest('.right-sidebar, form').find('.cover-image-wrapper');
                var $coverInput = $coverWrapper.find('input[type="hidden"]').first();

                if ($coverInput.length && $coverInput.val() === removedImageId) {
                    $coverInput.val('');

                    // Find the first remaining (still-visible) thumbnail in this gallery
                    var $remainingThumb = $galleryWrapper.find('.img-wrap .img-inner-wrap').filter(function () {
                        return $(this).is(':visible');
                    }).first();

                    if ($remainingThumb.length) {
                        var $newCoverBtn = $remainingThumb.find('.make-cover-btn');
                        if ($newCoverBtn.length) {
                            $newCoverBtn.trigger('click');
                        }
                    }
                }
            }

            togglePlaceholderVisibility($galleryWrapper.find('.img-wrap'));
        });



        // Manual "Kapak Yap" (Set Cover) selection.
        // Clicking a thumbnail's cover button sets that image's ID as the
        // listing's featured image (hidden input[name="image"]) and moves
        // the visual "cover" highlight to the clicked thumbnail only.
        $(document).on('click', '.make-cover-btn', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var $btn = $(this);
            var imageId = $btn.data('id');
            if (!imageId) return;

            var $galleryWrapper = $btn.closest('.media-upload-btn-wrapper');
            var $coverWrapper = $galleryWrapper.closest('.right-sidebar, form').find('.cover-image-wrapper');
            var $coverInput = $coverWrapper.find('input[type="hidden"]').first();

            if ($coverInput.length) {
                $coverInput.val(imageId);
            }

            // Reset highlight on all thumbnails within this gallery, then apply to the clicked one
            $galleryWrapper.find('.img-inner-wrap').each(function () {
                $(this).find('.cover-badge').remove();
                $(this).find('.make-cover-btn').removeClass('active-cover');
            });

            $btn.addClass('active-cover');
            $btn.closest('.img-inner-wrap').prepend(
                '<span class="cover-badge badge bg-primary position-absolute" style="top:4px;left:4px;z-index:2;">{{__("Kapak")}}</span>'
            );
        });

        // ---- Gallery Sorting (native HTML5 drag-and-drop) ----
        // No Sortable library (jQuery UI / SortableJS) is loaded in this project,
        // so a lightweight native DnD implementation is used instead.

        var $draggedThumb = null;

        // Normalize pre-rendered gallery thumbnails (server-side rendered on page load via
        // render_gallery_image_attachment_preview(), which outputs bare .attachment-preview
        // divs with NO .img-inner-wrap/.rmv-span/data-imageid) into the same DOM structure
        // used by the Dropzone-uploaded thumbnails, so delete/cover/sort logic works uniformly.
        $('.picture .img-wrap.new_image_gallery_add_listing').each(function () {
            var $imgWrap = $(this);
            var $galleryWrapper = $imgWrap.closest('.media-upload-btn-wrapper');
            var $hiddenInput = $galleryWrapper.find('input[type="hidden"]').first();
            var idsStr = $hiddenInput.val() || '';
            var ids = idsStr.split('|').filter(function (v) { return v !== ''; });

            var $coverWrapper = $galleryWrapper.closest('.right-sidebar, form').find('.cover-image-wrapper');
            var $coverInput = $coverWrapper.find('input[type="hidden"]').first();
            var coverId = $coverInput.length ? String($coverInput.val()) : '';

            var $rawPreviews = $imgWrap.find('> .attachment-preview');
            if ($rawPreviews.length && $rawPreviews.length === ids.length) {
                $rawPreviews.each(function (index) {
                    var imageId = ids[index];
                    var $preview = $(this);
                    var isCover = imageId === coverId;

                    var coverBadge = isCover
                        ? '<span class="cover-badge badge bg-primary position-absolute" style="top:4px;left:4px;z-index:2;">{{__("Kapak")}}</span>'
                        : '';
                    var coverBtnClass = isCover ? 'make-cover-btn active-cover' : 'make-cover-btn';

                    var $wrap = $('<div class="img-inner-wrap position-relative" draggable="true"></div>');
                    $wrap.append('<div class="rmv-span" data-imageid="' + imageId + '"><i class="{{$trash_icon}}"></i></div>');
                    if (coverBadge) $wrap.append(coverBadge);
                    $wrap.append('<button type="button" class="' + coverBtnClass + '" data-id="' + imageId + '" title="{{__("Kapak Yap")}}"><i class="las la-star"></i></button>');
                    $preview.before($wrap);
                    $wrap.append($preview);
                });
            }
        });

        // Mark any remaining pre-rendered gallery thumbnails as draggable too (safety net).
        $('.media-upload-btn-wrapper[data-mulitple] .img-wrap .img-inner-wrap, .picture .img-wrap .img-inner-wrap').attr('draggable', 'true');

        // Sync the placeholder icon visibility on page load for every gallery/upload block
        // (covers both pre-rendered gallery thumbnails and the single cover image block).
        $('.media-upload-btn-wrapper .img-wrap').each(function () {
            togglePlaceholderVisibility($(this));
        });



        function recalculateGalleryOrder($galleryWrapper) {
            var ids = [];
            $galleryWrapper.find('.img-wrap .img-inner-wrap').each(function () {
                var $rmv = $(this).find('.rmv-span');
                var imgId = $rmv.data('imageid');
                if (imgId !== undefined && imgId !== null && imgId !== '') {
                    ids.push(String(imgId));
                }
            });
            $galleryWrapper.find('input[type="hidden"]').first().val(ids.join('|'));
        }

        $(document).on('dragstart', '.img-wrap .img-inner-wrap[draggable="true"]', function (e) {
            $draggedThumb = $(this);
            $(this).addClass('dragging');
            if (e.originalEvent && e.originalEvent.dataTransfer) {
                e.originalEvent.dataTransfer.effectAllowed = 'move';
                try {
                    e.originalEvent.dataTransfer.setData('text/plain', '');
                } catch (err) {}
            }
        });

        $(document).on('dragend', '.img-wrap .img-inner-wrap[draggable="true"]', function () {
            $(this).removeClass('dragging');
            $draggedThumb = null;
        });

        $(document).on('dragover', '.img-wrap .img-inner-wrap[draggable="true"]', function (e) {
            e.preventDefault();
            if (!$draggedThumb || $draggedThumb.is($(this))) return;

            var $target = $(this);
            var draggedIndex = $draggedThumb.index();
            var targetIndex = $target.index();

            if (draggedIndex < targetIndex) {
                $draggedThumb.insertAfter($target);
            } else {
                $draggedThumb.insertBefore($target);
            }
        });

        $(document).on('drop', '.img-wrap .img-inner-wrap[draggable="true"]', function (e) {
            e.preventDefault();
            var $galleryWrapper = $(this).closest('.media-upload-btn-wrapper');
            recalculateGalleryOrder($galleryWrapper);
        });

        // Also allow dropping on the container itself (e.g. dropping past the last item)
        $(document).on('dragover', '.img-wrap', function (e) {
            e.preventDefault();
        });
        $(document).on('drop', '.img-wrap', function (e) {
            e.preventDefault();
            var $galleryWrapper = $(this).closest('.media-upload-btn-wrapper');
            recalculateGalleryOrder($galleryWrapper);
        });

        function loadAllImages() {

            var selectedImage = $('#load_all_media_images').attr('data-selectedimage');


            $.ajax({
                type: "POST",
                url: "{{route($type.'.upload.media.file.all')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    'selected' : selectedImage
                },
                success: function (data) {
                    $('.media-uploader-image-list').html('');
                    $.each(data,function (index,value) {

                        if($('.media-uploader-image-list li[data-imgid="'+value.image_id+'"]').length < 1){
                            $('.media-uploader-image-list').append('<li data-date="'+value.upload_at+'" data-imgid="'+value.image_id+'" data-imgsrc="'+value.img_url+'" data-size="'+value.size+'" data-dimension="'+value.dimensions+'" data-title="'+value.title+'" data-alt="'+value.alt+'">\n' +
                            '<div class="attachment-preview">\n' +
                            '<div class="thumbnail">\n' +
                            '<div class="centered">\n' +
                            '<img src="'+value.img_url+'" alt="">\n' +
                            '</div>\n' +
                            '</div>\n' +
                            '</div>\n' +
                            '</li>');
                        }

                    });
                    hidePreloader();
                    $('.media_upload_modal_submit_btn').show();
                    selectOldImage();
                    $('#loadmorewrap button').show();
                },
                error: function (error) {

                }
            });
        }



        /**
         * hide preloader
         * @since 2.2
         * */
        function hidePreloader() {
            $('.image-preloader-wrapper').hide(300);
        }

        /**
         * Select preveiously selected image
         * @since 2.2
         * */
        function selectOldImage(){
            var imageId = mainUploadBtn.prev('input').val();
            var matches = imageId.match(/([|])/g);
            if(matches != null){
                var imgArr = imageId.split('|');
                var filtered = imgArr.filter(function (el) {
                    return el != "";
                });
                $.each(filtered,function(index,value){
                    $('.media-uploader-image-list li[data-imgid="'+value+'"]').trigger('click');
                });
            }else{
                $('.media-uploader-image-list li[data-imgid="'+imageId+'"]').trigger('click').siblings().removeClass('selected');
            }
        }



        /* loadmore image  */
        $(document).on('click','#loadmorewrap',function (){
            var mediaImageWrapper = $('#media_library');
            var skipp = mediaImageWrapper.find('ul.media-uploader-image-list li').length - 1;
            $('#loadmorewrap button').append(' <i class="{{$spinner_icon}}"></i>'); //la spinner
            $.ajax({
                type: "POST",
                url: "{{route($type.'.upload.media.file.loadmore')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    'skip' : skipp
                },
                success: function (data) {
                    $.each(data,function (index,value) {
                        if($('.media-uploader-image-list li[data-imgid="'+value.image_id+'"]').length < 1){

                            mediaImageWrapper.find('.media-uploader-image-list').append('<li data-date="'+value.upload_at+'" data-imgid="'+value.image_id+'" data-imgsrc="'+value.img_url+'" data-size="'+value.size+'" data-dimension="'+value.dimensions+'" data-title="'+value.title+'" data-alt="'+value.alt+'">\n' +
                                '<div class="attachment-preview">\n' +
                                '<div class="thumbnail">\n' +
                                '<div class="centered">\n' +
                                '<img src="'+value.img_url+'" alt="">\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</li>');
                        }
                    });
                    if(data == ''){
                        $('#loadmorewrap button').hide();
                    }
                    $('#loadmorewrap button i').remove();
                },
                error: function (error) {

                }
            });
        });

    })(jQuery);
</script>
