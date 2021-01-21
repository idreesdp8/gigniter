jQuery(function($) {
      $('.pie_progress.booked-color-1').asPieProgress({        
            namespace: 'pie_progress',
            classes: {
            svg: 'pie_progress__svg',
            element: 'pie_progress',
            number: 'pie_progress__number',
            content: 'pie_progress__content'
            },
            min: 0,
            max: 100,
            goal: 100,
            size: 160,
            speed: 15, // speed of 1/100
            barcolor: '#31D7A9',
            barsize: '4',
            trackcolor: 'transparent',
            fillcolor: 'none',
            easing: 'ease',
            numberCallback: function numberCallback(n) {
              'use strict';

              var percentage = Math.round(this.getPercentage(n));

              return percentage + '%';
            },

            contentCallback: null
      });
      $('.pie_progress.booked-color-2').asPieProgress({        
            namespace: 'pie_progress',
            classes: {
            svg: 'pie_progress__svg',
            element: 'pie_progress',
            number: 'pie_progress__number',
            content: 'pie_progress__content'
            },
            min: 0,
            max: 100,
            goal: 100,
            size: 160,
            speed: 15, // speed of 1/100
            barcolor: '#EAC542',
            barsize: '4',
            trackcolor: 'transparent',
            fillcolor: 'none',
            easing: 'ease',
            numberCallback: function numberCallback(n) {
              'use strict';

              var percentage = Math.round(this.getPercentage(n));

              return percentage + '%';
            },

            contentCallback: null
      });
      $('.pie_progress.booked-color-3').asPieProgress({        
            namespace: 'pie_progress',
            classes: {
            svg: 'pie_progress__svg',
            element: 'pie_progress',
            number: 'pie_progress__number',
            content: 'pie_progress__content'
            },
            min: 0,
            max: 100,
            goal: 100,
            size: 160,
            speed: 15, // speed of 1/100
            barcolor: '#F6444C',
            barsize: '4',
            trackcolor: 'transparent',
            fillcolor: 'none',
            easing: 'ease',
            numberCallback: function numberCallback(n) {
              'use strict';

              var percentage = Math.round(this.getPercentage(n));

              return percentage + '%';
            },

            contentCallback: null
      });
      
      $('.pie_progress1.booked-color-1').asPieProgress({        
            namespace: 'pie_progress',
            classes: {
            svg: 'pie_progress__svg',
            element: 'pie_progress',
            number: 'pie_progress__number',
            content: 'pie_progress__content'
            },
            min: 0,
            max: 100,
            goal: 100,
            size: 160,
            speed: 15, // speed of 1/100
            barcolor: '#31D7A9',
            barsize: '4',
            trackcolor: 'transparent',
            fillcolor: 'none',
            easing: 'ease',
            numberCallback: function numberCallback(n) {
              'use strict';

              var percentage = Math.round(this.getPercentage(n));

              return percentage + '%';
            },

            contentCallback: null
      });
      $('.pie_progress2.booked-color-2').asPieProgress({        
            namespace: 'pie_progress',
            classes: {
            svg: 'pie_progress__svg',
            element: 'pie_progress',
            number: 'pie_progress__number',
            content: 'pie_progress__content'
            },
            min: 0,
            max: 100,
            goal: 100,
            size: 160,
            speed: 15, // speed of 1/100
            barcolor: '#EAC542',
            barsize: '4',
            trackcolor: 'transparent',
            fillcolor: 'none',
            easing: 'ease',
            numberCallback: function numberCallback(n) {
              'use strict';

              var percentage = Math.round(this.getPercentage(n));

              return percentage + '%';
            },

            contentCallback: null
      });
      $('.pie_progress3.booked-color-3').asPieProgress({        
            namespace: 'pie_progress',
            classes: {
            svg: 'pie_progress__svg',
            element: 'pie_progress',
            number: 'pie_progress__number',
            content: 'pie_progress__content'
            },
            min: 0,
            max: 100,
            goal: 100,
            size: 160,
            speed: 15, // speed of 1/100
            barcolor: '#F6444C',
            barsize: '4',
            trackcolor: 'transparent',
            fillcolor: 'none',
            easing: 'ease',
            numberCallback: function numberCallback(n) {
              'use strict';

              var percentage = Math.round(this.getPercentage(n));

              return percentage + '%';
            },

            contentCallback: null
      });
      // Example with grater loading time - loads longer
      $('.pie_progress--slow').asPieProgress({
        namespace: 'pie_progress',
        goal: 1000,
        min: 0,
        max: 1000,
        speed: 200,
        easing: 'linear'
      });
      // Example with grater loading time - loads longer
      $('.pie_progress--countdown').asPieProgress({
        namespace: 'pie_progress',
        easing: 'linear',
        first: 120,
        max: 120,
        goal: 0,
        speed: 1200, // 120 s * 1000 ms per s / 100
        numberCallback: function(n) {
          var minutes = Math.floor(this.now / 60);
          var seconds = this.now % 60;
          if (seconds < 10) {
            seconds = '0' + seconds;
          }
          return minutes + ': ' + seconds;
        }
      });

      $(document).ready(function(){
        $('.pie_progress').asPieProgress('start');
      });


   
    });