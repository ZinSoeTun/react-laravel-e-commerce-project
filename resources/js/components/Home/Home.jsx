import React, { useState } from "react";
import { Helmet } from "react-helmet";

import bgImg1 from "../../../../public/Image/bg-images/bg-1.jpg";
import bgImg2 from "../../../../public/Image/bg-images/bg-2.jpg";
import bgImg3 from "../../../../public/Image/bg-images/bg-3.jpg";
import bgImg4 from "../../../../public/Image/bg-images/bg-4.jpg";
import bgImg5 from "../../../../public/Image/bg-images/bg-5.jpg";
import bgImg6 from "../../../../public/Image/bg-images/bg-6.jpg";
import Mission from "./Mission";

export default function Home() {
   const [isLoading, setIsLoading] = useState(true)


    return (
        <div>
            <Helmet>
                <title>Home</title>
            </Helmet>
            <div className="carousel slide" id="carouselExampleCaptions">
                <div className="carousel-indicators">
                    <button
                        aria-current="true"
                        aria-label="Slide 1"
                        className="active"
                        data-bs-slide-to="0"
                        data-bs-target="#carouselExampleCaptions"
                        type="button"
                    />
                    <button
                        aria-label="Slide 2"
                        data-bs-slide-to="1"
                        data-bs-target="#carouselExampleCaptions"
                        type="button"
                    />
                    <button
                        aria-label="Slide 3"
                        data-bs-slide-to="2"
                        data-bs-target="#carouselExampleCaptions"
                        type="button"
                    />
                    <button
                        aria-label="Slide 4"
                        data-bs-slide-to="3"
                        data-bs-target="#carouselExampleCaptions"
                        type="button"
                    />
                    <button
                        aria-label="Slide 5"
                        data-bs-slide-to="4"
                        data-bs-target="#carouselExampleCaptions"
                        type="button"
                    />
                    <button
                        aria-label="Slide 6"
                        data-bs-slide-to="5"
                        data-bs-target="#carouselExampleCaptions"
                        type="button"
                    />
                </div>

                <div className="carousel-inner">
                    <div className="carousel-item active">
                        <img alt="..." className="d-block w-100" src={bgImg1} />
                        <div className="carousel-caption d-none d-md-block">
                            <h5>
                                Find the suitable office chair for your needs
                            </h5>
                        </div>
                    </div>

                    <div className="carousel-item">
                        <img alt="..." className="d-block w-100" src={bgImg2} />
                        <div className="carousel-caption d-none d-md-block">
                            <h5>
                                Flexible Solutions for Modern Workspaces Tyde 2
                            </h5>
                        </div>
                    </div>
                    <div className="carousel-item">
                        <img alt="..." className="d-block w-100" src={bgImg3} />
                        <div className="carousel-caption d-none d-md-block">
                            <h5>Moments in Architecture Magazine</h5>
                        </div>
                    </div>
                    <div className="carousel-item">
                        <img alt="..." className="d-block w-100" src={bgImg4} />
                        <div className="carousel-caption d-none d-md-block">
                            <h5>Plan Your Visit To Vitra Campus</h5>
                        </div>
                    </div>

                    <div className="carousel-item">
                        <img alt="..." className="d-block w-100" src={bgImg5} />
                        <div className="carousel-caption d-none d-md-block">
                            <h5>
                                No matter which industry and no matter where in
                                the world Our Clients
                            </h5>
                        </div>
                    </div>
                    <div className="carousel-item">
                        <img alt="..." className="d-block w-100" src={bgImg6} />
                        <div className="carousel-caption d-none d-md-block">
                            <h5>A case for classics Professionals</h5>
                        </div>
                    </div>
                </div>
                <button
                    className="carousel-control-prev"
                    data-bs-slide="prev"
                    data-bs-target="#carouselExampleCaptions"
                    type="button"
                >
                    <span
                        aria-hidden="true"
                        className="carousel-control-prev-icon"
                    />
                    <span className="visually-hidden">Previous</span>
                </button>
                <button
                    className="carousel-control-next"
                    data-bs-slide="next"
                    data-bs-target="#carouselExampleCaptions"
                    type="button"
                >
                    <span
                        aria-hidden="true"
                        className="carousel-control-next-icon"
                    />
                    <span className="visually-hidden">Next</span>
                </button>
            </div>
            <Mission />
        </div>
    );
}
