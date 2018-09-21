// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.smsstriker.com/leadsapp/FCMAdmin/js/firebase-app.js');
importScripts('https://www.smsstriker.com/leadsapp/FCMAdmin/js/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
  'messagingSenderId': '803296783333'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.

const messaging = firebase.messaging();
  messaging.setBackgroundMessageHandler(function(payload) {
  //console.log('[firebase-messaging-sw.js] Received background message ', payload);
//  self.analytics.trackEvent('push-received',10);
  // Customize notification here

  const notificationTitle = payload.data.title;
  var notificationOptions = {
					body:payload.data.body,
                    			icon:payload.data.icon,
					image:payload.data.image,
					tag:payload.data.tag,
					requireInteraction:payload.data.requireInteraction,
					badge:payload.data.badge


  }; 
   return self.registration.showNotification(notificationTitle,notificationOptions);
});

self.addEventListener('notificationclick', function(event) {
  console.log('Notification click: action', event);
 event.notification.close();
  var tagUrl = event.notification.badge;
  //console.log('Notification action - CTA : ', event);
  //var url = event.notification.tag;
  var url;
  if (event.notification.badge ==='' || typeof event.notification.badge === 'undefined') {
	url = 'https://www.smsstriker.com';
  } else {
	url = event.notification.badge;
  }
  event.waitUntil(
	Promise.all([
		clients.matchAll({
		  type: 'window'
		}).then(function(windowClients) {
		  console.log('WindowClients', windowClients);
		  for (var i = 0; i < windowClients.length; i++) {
			var client = windowClients[i];
			console.log('WindowClient', client);
			if (client.url === url && 'focus' in client) {
			  return client.focus();
			}
		  }
		  if (clients.openWindow) {
  console.log('Notification click: action', event);

			return clients.openWindow(url);    
          }
		}),

		//self.analytics.trackEvent('notification-click',11)
	])
  );
});
self.addEventListener('notificationclose', function(event) {
	console.log('Notification Close event : ', event);
 
event.waitUntil(notifypromise);
/* event.waitUntil(
    Promise.all([
     self.analytics.trackEvent('notification-close',12)
    ])
  );*/
});

