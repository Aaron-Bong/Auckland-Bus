﻿$(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 3000);
});

function cache_clear() {
  window.location.reload(true);
  // window.location.reload(); use this if you do not remove cache
}