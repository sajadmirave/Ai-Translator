// const word = [
//     {
//         "en": "Hi",
//         "fa": "سلام"
//     },
//     {
//         "en": "cat",
//         "fa": "گربه"
//     }, {
//         "en": "dog",
//         "fa": "سگ"
//     }
// ]

// let user = [];

// user.push("Hi");
// user.push("cat");

// word.map((i) => {
//     user.map((j) => {
//         if (i.en == j) {
//             console.log(i.fa)
//         }
//     })
// })

let sentence = "hello world";
let word = [];

for (let i = 0; i < sentence.length; i++) {
    word.push(sentence[i]);
    if (sentence[i] === " ") {
        
    }
}

console.log(word)