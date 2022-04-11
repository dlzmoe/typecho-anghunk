/* 
 * blogMenu plugin 1.0   2017-09-01 by cary
 */
(function ($) {

    var Menu = (function () {
        
        var Plugin = function(element, options) {
            this.$element = $(element);

            this.settings = $.extend({}, $.fn.autoMenu.defaults, typeof options === 'object' && options)
            this.init();
        }

        Plugin.prototype = {
            init: function () {
                var opts = this.settings;

                //console.log(opts)
                this.$element.html(this.createHtml());
                this.setActive();
                this.bindEvent();
                
            },
            createHtml: function(){
                var that = this;
                var opts = that.settings;
                var width = typeof opts.width === 'number' && opts.width;
                var height = typeof opts.height === 'number' && opts.height;
                var padding = typeof opts.padding === 'number' && opts.padding;
                that.$element.width(width+padding*2);
                var html = '<ul style="height: '+ height +'px;padding:' + padding + 'px">';
                var num = 0;
                $('*').each(function(){
                    var _this = $(this);
                    if(_this.get(0).tagName == opts.levelOne.toUpperCase()){
                        _this.attr('id',num);
                        var nodetext = that.handleTxt(_this.html());
                        html += '<li name="'+ num +'"><a href="#'+ num +'">'+ nodetext +'</a></li>';
                        num++;
                    }else if(_this.get(0).tagName == opts.levelTwo.toUpperCase()){
                        _this.attr('id',num);
                        var nodetext = that.handleTxt(_this.html());
                        html += '<li class="sub" name="'+ num +'"><a href="#'+ num +'">'+ nodetext +'</a></li>';
                        num++;
                    }
                })
                return html;   
            },
            handleTxt: function(txt){
                return txt.replace(/<\/?[^>]+>/g,"").trim();
            },
            setActive: function(){
                var $el = this.$element,
                    opts = this.settings,
                    items = opts.levelOne + ',' + opts.levelTwo,
                    $items = $(items),
                    offTop = opts.offTop,
                    top = $(document).scrollTop(),
                    currentId;
                if($(document).scrollTop()==0){
                    $el.find('li').removeClass('active').eq(0).addClass('active');
                    return;
                }
                $items.each(function(){
                    var m = $(this),
                        itemTop = m.offset().top;
                    if(top > itemTop-offTop){
                        currentId = m.attr('id');
                    }else{
                        return false;
                    }
                })
                var currentLink = $el.find('.active');
                if(currentId && currentLink.attr('name')!= currentId){
                  currentLink.removeClass('active');
                  $el.find('[name='+currentId+']').addClass('active');
                }
                
            },
            bindEvent: function(){
                var _this = this;
                $(window).scroll(function(){
                    _this.setActive()
                });
                _this.$element.on('click','.btn-box',function(){
                    if($(this).find('span').hasClass('icon-minus-sign')){
                        $(this).find('span').removeClass('icon-minus-sign').addClass('icon-plus-sign');
                        _this.$element.find('ul').fadeOut();
                    }else{
                        $(this).find('span').removeClass('icon-plus-sign').addClass('icon-minus-sign');
                        _this.$element.find('ul').fadeIn();
                    }
                    
                })
            }

        };

        return Plugin;

    })();

    $.fn.autoMenu = function (options) {
        return this.each(function () {
            var $el = $(this),
                menu = $el.data('autoMenu'),
                option = $.extend({}, $.fn.autoMenu.defaults, typeof options === 'object' && options);
            if (!menu) {
                $el.data('autoMenu',new Menu(this, option));
            }

            if ($.type(options) === 'string') menu[option]();
        });
    };

    $.fn.autoMenu.defaults = {
        levelOne : 'h2', 
        levelTwo : 'h3',  
        width : 240, 
        offTop : 100, 

    };

    $(function () {
        if($('[data-autoMenu]').length>0){
            new Menu($('[data-autoMenu]'));
        }
        
    });

})(jQuery);