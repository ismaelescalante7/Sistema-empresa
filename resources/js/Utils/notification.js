import { useNotification } from "@kyvg/vue3-notification";

export default function showNotification(title, mensage, type) {
    const { notify}  = useNotification()
    notify({
        title: title,
        text: mensage,
        type: type,
    });
}

