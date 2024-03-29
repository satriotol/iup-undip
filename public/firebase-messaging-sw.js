importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDMMP5VDAquaqIq29FPgn1Cku6IOaHZjAg",
    authDomain: "iup-undip.firebaseapp.com",
    projectId: "iup-undip",
    storageBucket: "iup-undip.appspot.com",
    messagingSenderId: "285237825437",
    appId: "1:285237825437:web:fd1f19a6b44f38a0f9a974",
    measurementId: "G-C56ZRHEFGH"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
});