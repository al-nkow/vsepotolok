import 'bootstrap/dist/js/bootstrap.js'
import 'bootstrap/dist/css/bootstrap.min.css'
import '../styles/style.scss';
import 'ubuntu-fontface/_ubuntu.scss'
import $ from 'jquery';
import Listeners from './listeners';

$(function() {

  $('.full-wrap').removeClass('hidden');
  $('.preloader').addClass('hidden');

  Listeners();

  $('#currentYear').text(new Date().getFullYear());
});