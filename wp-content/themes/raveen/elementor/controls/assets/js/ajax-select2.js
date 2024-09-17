(function ($) {
    $(document).on('rivax_select2_init', function (event, obj) {
        var ID = '#elementor-control-default-' + obj.data._cid;

        setTimeout(function () {
            var IDSelect2 = $(ID).select2({
                minimumInputLength: 3,
                ajax: {
                    url: function () {
                        var PostsSource = $('.elementor-control-posts_source select option:selected').val();
                        return rivax_select2_localize.ajaxurl + "?action=rivax_select2_search_query&posts_source=" + PostsSource +"&source_type=" + obj.data.source_type
                    },
                    dataType: 'json'
                },
                initSelection: function (element, callback) {
                    if (!obj.multiple) {
                        callback({id: '', text: rivax_select2_localize.search_text});
                    }else{
                        callback({id: '', text: ''});
                    }
                    var ids = [];
                    if(!Array.isArray(obj.currentID) && obj.currentID != ''){
                        ids = [obj.currentID];
                    }else if(Array.isArray(obj.currentID)){
                        ids = obj.currentID.filter(function (el) {
                            return el != null;
                        })
                    }

                    if (ids.length > 0) {
                        var label = $("label[for='elementor-control-default-" + obj.data._cid + "']");
                        label.after('<span class="elementor-control-spinner">&nbsp;<i class="eicon-spinner eicon-animation-spin"></i>&nbsp;</span>');
                        $.ajax({
                            method: "POST",
                            url: rivax_select2_localize.ajaxurl + "?action=rivax_select2_get_title",
                            data: {source_type: obj.data.source_type, id: ids}
                        }).done(function (response) {
                            if (response.success && typeof response.data.results != 'undefined') {
                                let rivaxSelect2Options = '';
                                ids.forEach(function (item, index){
                                    if(typeof response.data.results[item] != 'undefined'){
                                        const key = item;
                                        const value = response.data.results[item];
                                        rivaxSelect2Options += `<option selected="selected" value="${key}">${value}</option>`;
                                    }
                                })

                                element.append(rivaxSelect2Options);
                            }
                            label.siblings('.elementor-control-spinner').remove();
                        });
                    }
                }
            });


        }, 100);

    });
}(jQuery));