const ws = new WebSocket("wss://irc-ws.chat.twitch.tv:443");
const oAuth = "dnmyplxa5k01r6ipiswu7epemojrxg";
const nick = 'adangerousmix';
const channel = 'adangerousmix';

ws.addEventListener('open', () => {
    // ws.send('CAP REQ :twitch.tv/membership twitch.tv/tags twitch.tv/commands');
    ws.send(`PASS oauth:${oAuth}`);
    ws.send(`NICK ${nick}`);
    ws.send(`JOIN #${channel}`);
});

// ws.addEventListener('onopen', () => {
// });

ws.addEventListener('message', event => {
    // console.log(event.data);
    const message = event.data.split(' :')[1];
    const commandName = message.split(' ')[0];
    const request = message.replace(commandName, '').trim();
    const requester = event.data.split('!')[0].replace(':', '').trim();

    if (event.data.includes("PING")) ws.send("PONG");

    if (commandName === '!song') {
        let component = Livewire.getByName('createsong')[0];
        component.set('form.request', request);
        component.set('form.requester', requester);
        component.set('form.extra_life', false);
        component.set('form.donation', '0');
        component.save();
        Livewire.dispatch('song-created');
    } else {
        console.log('No command.');
    }
    if (event.data.includes("Hello world")) ws.send(`PRIVMSG #${channel} :cringe`);
});

Livewire.on('song-created', () => {
    console.log('Listener for song-created triggered.');
    let component = Livewire.getByName('queue')[0];
    component.updateSongs();
});
