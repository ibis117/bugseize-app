
export function useCreateAction(store, onSuccessfulCreate) {

    const onCreate = () => {
        store.update()
            .then(res => {
                onSuccessfulCreate()
            })
            .catch(err => console.log(err))
    }
    return {onCreate, onSuccessfulCreate}
}
