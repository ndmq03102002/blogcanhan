(function ($){
    "use strict";
    var HT = {};
    var document = $(document)
    var _token = $('meta[name="csrf-token"]').attr('content');
    HT.switchery = () => {
        $('.js-switch').each(function (){
            var switchery = new Switchery(this, {color: '#1AB394'});
        })
    }

    HT.changeStatus = () => {
        $(document).on('change', '.status', function(e){
            let _this = $(this)
            let option = {
                'value' : _this.val(),
                'modelId' : _this.attr('data-id'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                '_token' : _token
            }

            $.ajax({
                url: 'ajax/dashboard/changeStatus', 
                type: 'POST', 
                data: option,
                dataType: 'json', 
                success: function(res) {
                    let inputValue = ((option.value == 1)?0:0)
                    if(res.flag == true){
                        _this.val(inputValue)
                    }
                  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  
                  console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            });

            e.preventDefault()
        })
    }
    

    document.ready(function (){
        HT.switchery();
    });
})(jQuery);
