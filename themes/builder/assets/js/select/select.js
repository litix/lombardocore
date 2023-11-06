var $ = jQuery.noConflict();

$(function() {

    $('.custom-select-wrapper').click(function() {
        $(this).children(".dcustom-select").toggleClass('open');
    });

for (const option of document.querySelectorAll(".custom-option")) {
    option.addEventListener('click', function() {
        if (!this.classList.contains('selected')) {
            this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
            this.classList.add('selected');
            this.closest('.dcustom-select').querySelector('.custom-select__trigger span').textContent = this.textContent;
            var btn = this.getAttribute('data-value');

            var eventClick = new Event('click');
            document.dispatchEvent(eventClick);
        }
    })
}
});