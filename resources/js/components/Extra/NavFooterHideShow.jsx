import { useState, useEffect } from 'react'
import { useLocation } from "react-router-dom";

export default function NavFooterHideShow({ children }) {
    const location = useLocation();
    const [hideShow, setHideShow] = useState(false);
    useEffect(() => {
        if (location.pathname === '/register' || location.pathname === '/login') {
            setHideShow(false);
        } else {
            setHideShow(true);
        }
    }, [location]);

    return (
        <div>
            {hideShow && children}
        </div>
    )
}
