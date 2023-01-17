
// *=============== SHOW / HIDDEN INPUT ===============*/
const showHiddenInput = (inputOverlay, inputPass, inputIcon) =>{
    const overlay = document.getElementById(inputOverlay),
          input = document.getElementById(inputPass),
          iconEye = document.getElementById(inputIcon)
          
    iconEye.addEventListener('click', () =>{
        // Change password to text
        if(input.type === 'password'){
            // Switch to text
            input.type = 'text'

            // Change icon
            iconEye.classList.add('bx-show')
        }else{
            // Change to password
            input.type = 'password'

            // Remove icon
            iconEye.classList.remove('bx-show')
        }

        // Toggle the overlay
        overlay.classList.toggle('overlay-content')
    })
}

showHiddenInput('input-overlay', 'input-pass', 'input-icon')

$(function () {
    var bindDatePicker = function() {
         $(".date").datetimepicker({
         format:'YYYY-MM-DD',
             icons: {
                 time: "fa fa-clock-o",
                 date: "fa fa-calendar",
                 up: "fa fa-arrow-up",
                 down: "fa fa-arrow-down"
             }
         }).find('input:first').on("blur",function () {
             // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
             // update the format if it's yyyy-mm-dd
             var date = parseDate($(this).val());
 
             if (! isValidDate(date)) {
                 //create date based on momentjs (we have that)
                 date = moment().format('YYYY-MM-DD');
             }
 
             $(this).val(date);
         });
     }
    
    var isValidDate = function(value, format) {
         format = format || false;
         // lets parse the date to the best of our knowledge
         if (format) {
             value = parseDate(value);
         }
 
         var timestamp = Date.parse(value);
 
         return isNaN(timestamp) == false;
    }
    
    var parseDate = function(value) {
         var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
         if (m)
             value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);
 
         return value;
    }
    
    bindDatePicker();
  });