function getCookie(name) {
  const cookies = document.cookie.split('; ');

  for (const cookie of cookies) {
    const [cookieName, cookieValue] = cookie.split('=');

    if (cookieName === name) {
      return decodeURIComponent(cookieValue);
    }
  }
  return null;
}

function deleteCookie(name) {
  document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
}