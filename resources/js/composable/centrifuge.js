import {onMounted} from 'vue'
import { Centrifuge } from 'centrifuge';
import {useCentrifugeStore} from "../stores/centrifuge-store";
export function useCentrifuge() {

    const centrifugeStore = useCentrifugeStore();
    if (!centrifugeStore.userToken) {
        centrifugeStore.getUserToken(null);
    }
    const centrifuge = new Centrifuge('wss://centrifugo.sanilnakarmi.com.np/connection/websocket', {
        token: "",
        getToken: function (ctx) {
            return centrifugeStore.getUserToken(ctx).then(res => res.data.token);
        },
    });

    centrifuge.on('connecting', function (ctx) {
        console.log(`connecting: ${ctx.code}, ${ctx.reason}`);
    }).on('connected', function (ctx) {
        console.log(`connected over ${ctx.transport}`);
    }).on('disconnected', function (ctx) {
        console.log('disconnected');
    }).connect();

    // const sub = centrifuge.newSubscription();
    //
    // sub.on('publication', function (ctx) {
    //     // console.log("publish", ctx.data.value);
    // }).on('subscribing', function (ctx) {
    //     console.log('subscribing', ctx);
    // }).on('subscribed', function (ctx) {
    //     console.log('subscribed', ctx);
    // }).on('unsubscribed', function (ctx) {
    //     console.log('unsubscribed', ctx);
    // }).subscribe();



    return { centrifuge }
}
