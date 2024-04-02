import { Outlet, Navigate } from 'react-router-dom'
import Cookies from "universal-cookie";


const UnAuthenticatedRoute = () => {
    const cookies = new Cookies();
    const token = cookies.get('loginToken')
    return(
        !token ? <Outlet/> : <Navigate to="/*"/>
    )
}

export default UnAuthenticatedRoute
