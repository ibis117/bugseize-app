
export function useUpdateAction(store, onSuccessfulUpdate) {

    const onUpdate = () => {
        store.update()
            .then(res => {
                onSuccessfulUpdate()
            })
            .catch(err => console.log(err))
    }
    return {onUpdate, onSuccessfulUpdate}
}
