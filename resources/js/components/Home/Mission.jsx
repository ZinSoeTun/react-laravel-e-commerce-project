import React from 'react'
import VitraImg from "../../../../public/Image/bg-images/Vitra Image.jpg";
import "../../../css/app.css";

export default function Mission() {
  return (
    <div>
      <div
  className=""
>
  <div className="carousel-inner">
    <div className="">
      <img
        alt="mission"
        className="d-block w-100"
        src={VitraImg}
      />
      <div className="carousel-caption d-none d-md-block">
        <h1 className='text-center text-warning'>Vitra’s Environmental Mission</h1>
        <pre className='text-success text w-50 mx-auto fs-5'>
        Vitra’s Environmental Mission The urgent need for climate action
                has given rise to a new vocabulary. ‘CO₂ emissions’, ‘net zero’,
                ‘post-consumer plastic’ and other terms have become buzzwords.
                At Vitra, we spent the last years untangling and interpreting
                them. The result is this glossary, shared here to bring clarity
                and support fact-based conversations on this complex topic.
        </pre>
      </div>
    </div>
  </div>
</div>
    </div>
  )
}
