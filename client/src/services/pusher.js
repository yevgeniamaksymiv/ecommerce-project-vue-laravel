import Pusher from 'pusher-js';

const pusher = new Pusher(process.env.VUE_APP_WEBSOCKETS_KEY, {
  cluster: process.env.VUE_APP_WEBSOCKETS_CLUSTER,
});

pusher.logToConsole = true;

export default pusher;
