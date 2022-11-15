import {ref} from "vue";


// export function useCrud(store) {
//
//     const isLoading = ref(false);
//
//     const showModal = ref(false);
//
//     const onList = () => {
//         isLoading.value = true;
//         store.list()
//             .then(res => {
//                 isLoading.value = false;
//             })
//             .catch(err => console.log(err))
//     }
//
//     const onCreate = () => {
//         store.example = {};
//         showModal.value = true;
//     }
//
//     const onUpdate = (row) => {
//         store.example = row;
//         showModal.value = true;
//     }
//
//     const onDelete = (id) => {
//         store.example
//     }
//
//     return { onList, onCreate, onUpdate, onDelete, isLoading, showModal }
// }
