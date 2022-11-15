import {ref} from "vue";

export function useListAction(store) {

    const isLoading = ref(false);

    const onList = () => {
        isLoading.value = true;
        store.list(filters())
            .then(res => {
                isLoading.value = false;
            })
            .catch(err => console.log(err))
    }

    const filters = () => {
        return {}
    }

    return {onList, filters, isLoading}
}
