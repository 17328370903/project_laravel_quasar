import {Notify} from "quasar"


export default {
    success: (message) => {
        Notify.create({
            type: "positive",
            message,
            position: 'top',
        })
    },

    warning: (message) => {
        Notify.create({
            type: "warning",
            message,
            position: 'top',
        })
    },
    error: (message) => {
        Notify.create({
            type: "negative",
            message,
            position: 'top',

        })
    }
}
