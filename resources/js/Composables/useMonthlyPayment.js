import { computed, isRef } from 'vue';

export const useMonthlyPayment = (total, interestRate, duration) => {
    const monthlyPayment = computed(()=>{
    const initialPrice = isRef(total)? total.value : total;
    const monthlyInterestRate = (isRef(interestRate)?interestRate.value:interestRate )/100/12;
    const numberOfPayments = (isRef(duration)? duration.value : duration)*12;

        return initialPrice*monthlyInterestRate*(Math.pow(1+monthlyInterestRate, numberOfPayments))/ (Math.pow(1 + monthlyInterestRate,numberOfPayments)-1);
    })

    return {
        monthlyPayment
    }

}