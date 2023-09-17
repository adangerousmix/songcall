import { config } from '../../config';

const socket = new WebSocket(config.twitch.url);
const oAuth = config.twitch.oauth;
const nick = config.twitch.nick;
const channel = config.twitch.channel;

socket.addEventListener('open', () => {
    // socket.send('CAP REQ :twitch.tv/membership twitch.tv/tags twitch.tv/commands');
    socket.send(`PASS oauth:${oAuth}`);
    socket.send(`NICK ${nick}`);
    socket.send(`JOIN #${channel}`);
    console.log('Websocket opened.');
});

socket.addEventListener('error', (event) => {
    console.log(event);
});

socket.addEventListener('close', (event) => {
    console.log(event);
    console.log('Websocket closed.');
    if (event.code == 1000) {
        console.log("Normal closure, meaning that the purpose for which the connection was established has been fulfilled.");
    } else if(event.code == 1001) {
        console.log("An endpoint is \"going away\", such as a server going down or a browser having navigated away from a page.");
    } else if(event.code == 1002) {
        console.log("An endpoint is terminating the connection due to a protocol error");
    } else if(event.code == 1003) {
        console.log("An endpoint is terminating the connection because it has received a type of data it cannot accept (e.g., an endpoint that understands only text data MAY send this if it receives a binary message).");
    } else if(event.code == 1004) {
        console.log("Reserved. The specific meaning might be defined in the future.");
    } else if(event.code == 1005) {
        console.log("No status code was actually present.");
    } else if(event.code == 1006) {
        console.log("The connection was closed abnormally, e.g., without sending or receiving a Close control frame");
    } else if(event.code == 1007) {
        console.log("An endpoint is terminating the connection because it has received data within a message that was not consistent with the type of the message (e.g., non-UTF-8 [https://www.rfc-editor.org/rfc/rfc3629] data within a text message).");
    } else if(event.code == 1008) {
        console.log("An endpoint is terminating the connection because it has received a message that \"violates its policy\". This reason is given either if there is no other sutible reason, or if there is a need to hide specific details about the policy.");
    } else if(event.code == 1009) {
        console.log("An endpoint is terminating the connection because it has received a message that is too big for it to process.");
    } else if(event.code == 1010) { // Note that this status code is not used by the server, because it can fail the WebSocket handshake instead.
        console.log("An endpoint (client) is terminating the connection because it has expected the server to negotiate one or more extension, but the server didn't return them in the response message of the WebSocket handshake. <br /> Specifically, the extensions that are needed are: " + event.reason);
    } else if(event.code == 1011) {
        console.log("A server is terminating the connection because it encountered an unexpected condition that prevented it from fulfilling the request.");
    } else if(event.code == 1015) {
        console.log("The connection was closed due to a failure to perform a TLS handshake (e.g., the server certificate can't be verified).");
    } else {
        console.log("Unknown reason");
    }
});

socket.addEventListener('message', event => {
    if (event.data.includes("PING")) socket.send("PONG");
    if (!event.data.includes("!song")) return;
    // console.log(event.data);
    const message = event.data.split(' :')[1];
    const commandName = message.split(' ')[0];
    const request = message.replace(commandName, '').trim();
    const requester = event.data.split('!')[0].replace(':', '').trim();

    if (commandName === '!song') {
        let component = Livewire.getByName('create-song')[0];
        component.set('form.request', request);
        component.set('form.requester', requester);
        component.set('form.extra_life', false);
        component.set('form.donation', '0');
        component.save();
        Livewire.dispatch('song-created');
    } else {
        console.log('No command.');
    }
    if (event.data.includes("Hello world")) socket.send(`PRIVMSG #${channel} :cringe`);
});

Livewire.on('song-created', () => {
    let component = Livewire.getByName('queue')[0];
    component.updateSongs();
});
