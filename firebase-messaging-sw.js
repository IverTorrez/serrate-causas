importScripts('https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js');
/*Update this config*/
var firebaseConfig = {
    apiKey: "AIzaSyCzZmsCOBlZ3919YXWXBW9EjGeOeLW3pGs",
    authDomain: "proyectocausas.firebaseapp.com",
    databaseURL: "https://proyectocausas.firebaseio.com",
    projectId: "proyectocausas",
    storageBucket: "proyectocausas.appspot.com",
    messagingSenderId: "841093566284",
    appId: "1:841093566284:web:4fcb8682f97b7b9eed49e9",
    measurementId: "G-T2XQX77ZTG"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon:  payload.data.icon,
    requireInteraction: 'true',
    sound: payload.data.sound,
  vibrate: payload.data.vibrate,
	image: 'http://localhost/notificacionpush/gcm-push/img/d.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
// [END background_handler]