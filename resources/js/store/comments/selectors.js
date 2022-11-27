export const getCommentsArticle = (state) => {
       console.log("comments -", state.comments)
       console.log("comments -", state.comments.length == 0 ? [] : state.comments.comments)
    return state.comments.length == 0 ? [] : state.comments.comments
};

export const getCommentsUser = (state) => {
  // console.log(state.categories)
return state.categories.links || []

};


