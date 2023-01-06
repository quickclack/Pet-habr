export const getCommentsArticle = (state) => {
  // console.log("comments -", state.comments.length == 0 ? [] : state.comments.comments)
  return state.comments.length == 0 ? [] : state.comments.comments
};

export const getCommentsUser = (state) => {
  // console.log(state.categories)
  return state.comments.links || []
};

export const getMainCommentVisible = (state) => {
  // console.log(state.comments.mainCommentVisible)
  return state.comments.mainCommentVisible || ''
};

export const getCommentsLoad = (state) => {
  // console.log("comments -", state.comments.length == 0 ? [] : state.comments.comments)
  return state.comments.length == 0 ? [] : state.comments.commentsLoader
};
export const getCommentsProfile = (state) => {
    console.log("comments -", state.comments)
    return state.comments.length == 0 ? [] : state.comments.comments
};
