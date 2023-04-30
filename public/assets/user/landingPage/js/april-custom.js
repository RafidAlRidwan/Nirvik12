'use strict';
              var kagepisuceng = (function(config) {

                     const ClassName = {
                            INDICATOR_ACTIVE: 'kagepisuceng__indicator_active',
                            ITEM: 'kagepisuceng__item',
                            ITEM_LEFT: 'kagepisuceng__item_left',
                            ITEM_RIGHT: 'kagepisuceng__item_right',
                            ITEM_PREV: 'kagepisuceng__item_prev',
                            ITEM_NEXT: 'kagepisuceng__item_next',
                            ITEM_ACTIVE: 'kagepisuceng__item_active'
                     }

                     var
                            _isSliding = false, // индикация процесса смены слайда
                            _interval = 0, // числовой идентификатор таймера
                            _transitionDuration = 700, // длительность перехода
                            _kagepisuceng = {}, // DOM элемент слайдера
                            _items = {}, // .kagepisuceng-item (массив слайдов)  
                            _kagepisucengIndicators = {}, // [data-slide-to] (индикаторы)
                            _config = {
                                   selector: '', // селектор слайдера
                                   isCycling: true, // автоматическая смена слайдов
                                   direction: 'next', // направление смены слайдов
                                   interval: 5000, // интервал между автоматической сменой слайдов
                                   pause: true // устанавливать ли паузу при поднесении курсора к слайдеру
                            };

                     var
                            // функция для получения порядкового индекса элемента
                            _getItemIndex = function(_currentItem) {
                                   var result;
                                   _items.forEach(function(item, index) {
                                          if (item === _currentItem) {
                                                 result = index;
                                          }
                                   });
                                   return result;
                            },
                            // функция для подсветки активного индикатора
                            _setActiveIndicator = function(_activeIndex, _targetIndex) {
                                   if (_kagepisucengIndicators.length !== _items.length) {
                                          return;
                                   }
                                   _kagepisucengIndicators[_activeIndex].classList.remove(ClassName.INDICATOR_ACTIVE);
                                   _kagepisucengIndicators[_targetIndex].classList.add(ClassName.INDICATOR_ACTIVE);
                            },

                            // функция для смены слайда
                            _slide = function(direction, activeItemIndex, targetItemIndex) {
                                   var
                                          directionalClassName = ClassName.ITEM_RIGHT,
                                          orderClassName = ClassName.ITEM_PREV,
                                          activeItem = _items[activeItemIndex], // текущий элемент
                                          targetItem = _items[targetItemIndex]; // следующий элемент

                                   var _slideEndTransition = function() {
                                          activeItem.classList.remove(ClassName.ITEM_ACTIVE);
                                          activeItem.classList.remove(directionalClassName);
                                          targetItem.classList.remove(orderClassName);
                                          targetItem.classList.remove(directionalClassName);
                                          targetItem.classList.add(ClassName.ITEM_ACTIVE);
                                          window.setTimeout(function() {
                                                 if (_config.isCycling) {
                                                        clearInterval(_interval);
                                                        _cycle();
                                                 }
                                                 _isSliding = false;
                                                 activeItem.removeEventListener('transitionend', _slideEndTransition);
                                          }, _transitionDuration);
                                   };

                                   if (_isSliding) {
                                          return;
                                   }
                                   _isSliding = true;

                                   if (direction === "next") {
                                          directionalClassName = ClassName.ITEM_LEFT;
                                          orderClassName = ClassName.ITEM_NEXT;
                                   }

                                   targetItem.classList.add(orderClassName);
                                   _setActiveIndicator(activeItemIndex, targetItemIndex);
                                   window.setTimeout(function() {
                                          targetItem.classList.add(directionalClassName);
                                          activeItem.classList.add(directionalClassName);
                                          activeItem.addEventListener('transitionend', _slideEndTransition);
                                   }, 0);

                            },

                            _slideTo = function(direction) {
                                   var
                                          activeItem = _kagepisuceng.querySelector('.' + ClassName.ITEM_ACTIVE),
                                          activeItemIndex = _getItemIndex(activeItem),
                                          lastItemIndex = _items.length - 1,
                                          targetItemIndex = activeItemIndex === 0 ? lastItemIndex : activeItemIndex - 1;
                                   if (direction === "next") {
                                          targetItemIndex = activeItemIndex == lastItemIndex ? 0 : activeItemIndex + 1;
                                   }
                                   _slide(direction, activeItemIndex, targetItemIndex);
                            },

                            _cycle = function() {
                                   if (_config.isCycling) {
                                          _interval = window.setInterval(function() {
                                                 _slideTo(_config.direction);
                                          }, _config.interval);
                                   }
                            },

                            _actionClick = function(e) {
                                   var
                                          activeItem = _kagepisuceng.querySelector('.' + ClassName.ITEM_ACTIVE),
                                          activeItemIndex = _getItemIndex(activeItem),
                                          targetItemIndex = e.target.getAttribute('data-slide-to');

                                   if (!(e.target.hasAttribute('data-slide-to') || e.target.classList.contains('kagepisuceng__control'))) {
                                          return;
                                   }
                                   if (e.target.hasAttribute('data-slide-to')) {
                                          if (activeItemIndex === targetItemIndex) {
                                                 return;
                                          }
                                          _slide((targetItemIndex > activeItemIndex) ? 'next' : 'prev', activeItemIndex, targetItemIndex);
                                   } else {
                                          e.preventDefault();
                                          _slideTo(e.target.classList.contains('kagepisuceng__control_next') ? 'next' : 'prev');
                                   }
                            },

                            _setupListeners = function() {

                                   _kagepisuceng.addEventListener('click', _actionClick);

                                   if (_config.pause && _config.isCycling) {
                                          _kagepisuceng.addEventListener('mouseenter', function(e) {
                                                 clearInterval(_interval);
                                          });
                                          _kagepisuceng.addEventListener('mouseleave', function(e) {
                                                 clearInterval(_interval);
                                                 _cycle();
                                          });
                                   }
                            };

                     for (var key in config) {
                            if (key in _config) {
                                   _config[key] = config[key];
                            }
                     }
                     _kagepisuceng = (typeof _config.selector === 'string' ? document.querySelector(_config.selector) : _config.selector);
                     _items = _kagepisuceng.querySelectorAll('.' + ClassName.ITEM);
                     _kagepisucengIndicators = _kagepisuceng.querySelectorAll('[data-slide-to]');
                     // запуск функции cycle
                     _cycle();
                     _setupListeners();

                     return {
                            next: function() {
                                   _slideTo('next');
                            },
                            prev: function() {
                                   _slideTo('prev');
                            },
                            stop: function() {
                                   clearInterval(_interval);
                            },
                            cycle: function() {
                                   clearInterval(_interval);
                                   _cycle();
                            }
                     }
              }({
                     selector: '.kagepisuceng',
                     isCycling: false,
                     direction: 'next',
                     interval: 5000,
                     pause: true
              }));





          // Counter To Count Number Visit
          var a = 0;
          $(window).scroll(function() {

                 var oTop = $('#funfact-area').offset().top - window.innerHeight;
                 if (a == 0 && $(window).scrollTop() > oTop) {
                        $('.funfact-count').each(function() {
                               var $this = $(this);
                               jQuery({
                                      Counter: 0
                               }).animate({
                                      Counter: $this.text()
                               }, {
                                      duration: 2000,
                                      easing: 'swing',
                                      step: function() {
                                             $this.text(Math.ceil(this.Counter));
                                      }
                               });
                        });
                        a = 1;
                 }
          });