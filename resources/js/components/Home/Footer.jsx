import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faFacebook,
    faFacebookMessenger,
    faInstagram,
    faXTwitter,
    faLinkedin
} from "@fortawesome/free-brands-svg-icons";
import  '../../../css/app.css'





export default function Footer() {
    return (
        <div>
            <div
                className="bg-dark w-100 text-success text-center fs-4 fw-bold"
                style={{ height: "30vh"}}
            >
                <FontAwesomeIcon icon={faFacebook}  className="text-primary mt-5 me-4 fs-3 fason"/>
                 <FontAwesomeIcon icon={faFacebookMessenger}  className="text-danger mt-5 me-4 fs-3 fason"/>
                 <FontAwesomeIcon icon={faInstagram} className="text-danger mt-5 me-4 fs-3 fason" />
                 <FontAwesomeIcon icon={faXTwitter} className="text-light me-4 fs-3 fason" />
                 <FontAwesomeIcon icon={faLinkedin}  className="text-primary me-4 fs-3 fason"/>
                 <div style={{paddingTop: '20px'}}>
                 COPYRIGHT © 2024 VITRA INTERNATIONAL AG.
                 </div>
            </div>
        </div>
    );
}
