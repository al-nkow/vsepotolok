import $ from 'jquery';

const Listeners = () => {

  const scrollToElement = (id, duration) => {
    $('html, body').animate({
      scrollTop: id ? $(id).offset().top : 0
    }, duration || 2000);
  };

  $('.scrollToExamples').on('click', () => scrollToElement('#examples', 1000));
  $('.scrollToCalc').on('click', () => scrollToElement('#calculator', 1000));
  $('.totop').on('click', () => scrollToElement(null, 'slow'));

  $('.jsMobMenuItem').on('click', () => $('#mobMenu').toggleClass('visible'));

  $('.jintinp').on('keyup', (event) => {
    event.target.value = event.target.value.replace(/[^\d]/g, '');
    getPrice();
  });

  $('.jletterinp').on('keyup', (event) => {
    event.target.value = event.target.value.replace(/[^а-я А-Яa-zA-Z]/g, '');
  });

  $('.jphoneinp').on('keyup', (event) => {
    event.target.value = event.target.value.replace(/[^\d ()\-+]/g, '');
  });

  $('#callForm').on('submit', (event) => {
    event.preventDefault();
    const data = getFormValues('#callForm', true);
    console.log('=== SUBMIT ===', data);

    if (!data.name || !data.phone) return;

    fetch('/mail/mail.php', {
      method: 'post',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    }).then((res) => {
        console.log('RESULT: ', res);
        const el = $('.jsSendSuccess');
        el.removeClass('hide');
        setTimeout(() => {
          el.addClass('hide');
          $('#callModal').modal('hide');
        }, 2000);
      })
      .catch((error) => {
        console.log('SEND MAIL:', error);
        const el = $('.jsSendError');
        el.removeClass('hide');
        setTimeout(() => { el.addClass('hide')}, 2000);
      });
  });

  const getFormValues = function (formName, str) {
    const form = $(formName);
    const strValues = form.serializeArray();
    const data = {};
    strValues.forEach((item) => {
      data[item.name] = str ? item.value : +item.value;
    });
    return data;
  };

  const getPrice = function () {
    const data = getFormValues('#calcform');
    const { square, angles, pipes, lamps, lusters } = data;
    if (!square || !angles) {
      $('.result-price').text('0 руб.');
      return;
    }
    const resAngles = angles >= 4 ? angles - 4 : 0;
    const result = square * 400 + resAngles * 150 + pipes * 200 + lamps * 200 + lusters * 400;
    $('.result-price').text(`${result} руб.`);
  };

};

export default Listeners;