
export function useDeleteAction(store, onSuccessfulDelete) {

    const onDelete = (id) => {
        store.delete(id)
            .then(res => {
                onSuccessfulDelete()
            })
            .catch(err => console.log(err))
    }
    return {onDelete, onSuccessfulDelete}
}
