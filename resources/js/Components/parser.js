export const parser = (value) =>
    !Number.isNaN(parseFloat(value))
        ? `Rp. ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        : "Rp. ";
