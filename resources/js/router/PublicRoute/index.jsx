import { Outlet } from "react-router-dom";
import { useSelector } from "react-redux";
import { getIsAuth } from "../../store/userAuth";
import All from '../../pages/All';

export const PublicRoute = () => {
    const isAuthed = useSelector(getIsAuth);
    return isAuthed ? <Outlet /> : <All />
};
