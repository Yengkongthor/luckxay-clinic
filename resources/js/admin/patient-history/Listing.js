import AppListing from '../app-components/Listing/AppListing';

import {
    GetCommentQueue,
} from '../event-bus/app-events';



var FormSupport = {
    data: function () {
        return {
            form: {
                comment: ''
            },
            mediaWysiwygConfig: {
                autogrow: true,
                imageWidthModalEdit: true,
                btnsDef: {
                    image: {
                        dropdown: ['insertImage', 'upload', 'base64'],
                        ico: 'insertImage'
                    },
                    align: {
                        dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ico: 'justifyLeft'
                    }
                },
                btns: [
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['align'],
                    ['unorderedList', 'orderedList', 'table'],
                    ['foreColor', 'backColor'],
                    ['link', 'noembed', 'image'],
                    ['template'],
                    ['fullscreen', 'viewHTML']
                ],
                plugins: {
                    upload: {
                        // https://alex-d.github.io/Trumbowyg/documentation/plugins/#plugin-upload
                        serverPath: '/admin/wysiwyg-media',
                        imageWidthModalEdit: true,
                        success: function success(data, trumbowyg, $modal, values) {
                            that.wysiwygMedia.push(data.mediaId);

                            function getDeep(object, propertyParts) {
                                var mainProperty = propertyParts.shift(),
                                    otherProperties = propertyParts;

                                if (object !== null) {
                                    if (otherProperties.length === 0) {
                                        return object[mainProperty];
                                    }

                                    if ((typeof object === 'undefined' ? 'undefined' : _typeof(object)) === 'object') {
                                        return getDeep(object[mainProperty], otherProperties);
                                    }
                                }
                                return object;
                            }

                            if (!!getDeep(data, trumbowyg.o.plugins.upload.statusPropertyName.split('.'))) {
                                var url = getDeep(data, trumbowyg.o.plugins.upload.urlPropertyName.split('.'));
                                trumbowyg.execCmd('insertImage', url, false, true);
                                var $img = $('img[src="' + url + '"]:not([alt])', trumbowyg.$box);
                                $img.attr('alt', values.alt);
                                if (trumbowyg.o.imageWidthModalEdit && parseInt(values.width) > 0) {
                                    $img.attr({
                                        width: values.width
                                    });
                                }
                                setTimeout(function () {
                                    trumbowyg.closeModal();
                                }, 250);
                                trumbowyg.$c.trigger('tbwuploadsuccess', [trumbowyg, data, url]);
                            } else {
                                trumbowyg.addErrorOnModalField($('input[type=file]', $modal), trumbowyg.lang[data.message]);
                                trumbowyg.$c.trigger('tbwuploaderror', [trumbowyg, data]);
                            }
                        }
                    },
                    reupload: {
                        success: function success(data, trumbowyg, $modal, values, $img) {
                            that.wysiwygMedia.push(data.mediaId);

                            $img.attr({
                                src: data.file
                            });
                            trumbowyg.execCmd('insertHTML');
                            setTimeout(function () {
                                trumbowyg.closeModal();
                            }, 250);
                            var url = getDeep(data, trumbowyg.o.plugins.upload.urlPropertyName.split('.'));
                            trumbowyg.$c.trigger('tbwuploadsuccess', [trumbowyg, data, url]);
                        }
                    }
                }
            }
        }
    },

}




Vue.component('patient-history-listing', {
    mixins: [AppListing, FormSupport],
    data: function () {
        return {
            patient: '',
            examination_lab: '',
            information_history_detail: '',
            history_medicine: '',
            queue_comment: ''
        }
    },
    created() {
        this.$eventBus.listen(GetCommentQueue, (event) => {
            this.form.comment = event.item.comment
        });
    },
    beforeDestory() {
        this.$eventBus.remove(GetCommentQueue);
    },
    methods: {
        showModalPatientHistoryView(item) {
            this.$modal.show('patient-history-view', {
                item: item
            });
        },
        hideModalPatientHistoryView() {
            this.$modal.hide('patient-history-view');
        },
        beforeOpen(event) {
            var item = event.params.item;
            this.patient = item.patient;
            this.examination_lab = item.examination_lab;
            this.information_history_detail = item.information_history_detail;
            this.history_medicine = item.history_medicine;
            this.queue_comment = item.queue_comment

        },
        titleCase(str) {
            var splitStr = str.toLowerCase().split('_');
            for (var i = 0; i < splitStr.length; i++) {
                // You do not need to check if i is larger than splitStr length, as your for does that for you
                // Assign it back to the array
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }
            // Directly return the joined string
            return splitStr.join(' ');
        }
    },

});
